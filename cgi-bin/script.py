#!/usr/bin/env python

from sklearn.model_selection import train_test_split
from keras.models import Sequential
from keras.layers.core import Dense, Activation
import os
import pandas as pd
import io
import numpy as np
from sklearn import metrics
import numpy as np
from sklearn import metrics
from keras.callbacks import EarlyStopping
from keras.callbacks import ModelCheckpoint
import matplotlib.pyplot as plt


import sys
import json
import cgi

sys.stdout.write("Content-Type: application/json")

sys.stdout.write("\n")
sys.stdout.write("\n")

path = "/srv/http/pollvot/cgi-bin/"
filename_read = os.path.join(path,"dvotes.csv")


fs = cgi.FieldStorage()

#read the content inside a DataFrame object
df = pd.read_csv(filename_read,na_values=['NA','?'])

def missing_median(df, name):
    med = df[name].median()
    df[name] = df[name].fillna(med)

'''
cars = df['car name']
df.drop('car name',1,inplace=True)

missing_median(df, 'horsepower')
'''

#dataset is an object of type numpy.ndarray
dataset=df.values
x=dataset[:,[0, 1, 2, 3, 4, 5, 6]] #8 pentru ca din cele 9 coloane am eliminat car name
y=dataset[:,7] #stabilim ca variabila scop mpg

'''
print(dataset)
print("\n\n X \n\n")
print(x)
print("\n\n Y \n\n")
print(y)
'''

# Split into train/test
x_train, x_test, y_train, y_test = train_test_split(x, y, test_size=0.25, random_state=45)

model = Sequential()
model.add(Dense(25, input_dim=x.shape[1], activation='relu')) # Hidden 1
model.add(Dense(10, activation='relu'))# Hidden 2
model.add(Dense(1)) # Output
model.compile(loss='mean_squared_error', optimizer='adam')

monitor = EarlyStopping(monitor='val_loss', min_delta=1e-3, patience=5, verbose=0, mode='auto')
model.fit(x_train,y_train,validation_data=(x_test,y_test),callbacks=[monitor],verbose=0,epochs=100)
#model.fit(x_train,y_train,validation_data=(x_test,y_test),verbose=2,epochs=500)

#print(x_test)

#print("\n \n")

arr = np.arange(7)

# values come in random order
for k in fs.keys():
    if (k == "education"):
        arr[0] = fs.getvalue(k)
    if (k == "income"):
        arr[1] = fs.getvalue(k)
    if (k == "family"):
        arr[2] = fs.getvalue(k)
    if (k == "region"):
        arr[3] = fs.getvalue(k)
    if (k == "county"):
        arr[4] = fs.getvalue(k)
    if (k == "age"):
        arr[5] = fs.getvalue(k)
    if (k == "area"):
        arr[6] = fs.getvalue(k)

#print(arr)

a = np.array([arr])
#print(a.shape)
pred = model.predict(a)
#print("Shape: {}".format(pred.shape))
#print("\n \n")
#print(pred[[0]])

#pd.Series(pred).to_json(orient='values')
for x in np.nditer(pred):
    val = x

#print(val)
arr = val.ravel()

#print(arr[0])

'''
print(d)
result['data'] = d
'''

result = {}
result['pred'] = json.dumps(int(round(arr[0].item())))  

sys.stdout.write(json.dumps(result,indent=1))
sys.stdout.write("\n")

sys.stdout.close()


'''
# Measure MSE error.  
score = metrics.mean_squared_error(pred,y_test)
print("Final score (MSE): {}".format(score))

# Measure RMSE error.  RMSE is common for regression.
score = np.sqrt(metrics.mean_squared_error(pred,y_test))
print("Final score (RMSE):{}".format(score))

# Sample predictions
for i in range(10):
    print("{}. Car name: {}, MPG: {}, predicted MPG: {}".format(i+1,cars[i],y[i],pred[i]))
'''
'''
#--------------------------------------------------------------------------
# Regression chart.
def chart_regression(pred, y, sort=True):
    t = pd.DataFrame({'pred': pred, 'y': y.flatten()})
    if sort:
        t.sort_values(by=['y'], inplace=True)
    plt.plot(t['y'].tolist(), label='expected')
    plt.plot(t['pred'].tolist(), label='prediction')
    plt.ylabel('output')
    plt.legend()
    plt.show()

# Plot the chart
chart_regression(pred.flatten(),y_test)
'''
