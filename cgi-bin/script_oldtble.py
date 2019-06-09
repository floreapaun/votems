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

path = "/home/florea/Projects/rna/"
filename_read = os.path.join(path,"auto-mpg.csv")


#read the content inside a DataFrame object
df = pd.read_csv(filename_read,na_values=['NA','?'])

def missing_median(df, name):
    med = df[name].median()
    df[name] = df[name].fillna(med)

cars = df['car name']
df.drop('car name',1,inplace=True)

missing_median(df, 'horsepower')

#dataset is an object of type numpy.ndarray
dataset=df.values
x=dataset[:,[1, 2, 3, 5, 6, 7]] #8 pentru ca din cele 9 coloane am eliminat car name
y=dataset[:,0] #stabilim ca variabila scop mpg

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

a = np.array([[4, 88, 76, 14.5, 71, 2]])
#print(a.shape)
pred = model.predict(a)
#print("Shape: {}".format(pred.shape))
#print("\n \n")
#print(pred)

result = {}
result['success'] = True
result['message'] = "The command Completed Successfully"
result['keys'] = ",".join(fs.keys())

d = {}
for k in fs.keys():
    d[k] = fs.getvalue(k)

result['data'] = d
result = {}
result['pred'] = 33

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
