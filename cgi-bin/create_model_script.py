#!/usr/bin/env python
from sklearn.model_selection import train_test_split
from keras.models import load_model
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

#dataset is an object of type numpy.ndarray
dataset=df.values
x=dataset[:,[0, 1, 2, 3, 4, 5, 6]] 
y=dataset[:,7] 

# Split into train/test
x_train, x_test, y_train, y_test = train_test_split(x, y, test_size=0.25, random_state=45)

model = Sequential()
model.add(Dense(25, input_dim=x.shape[1], activation='relu')) # Hidden 1
model.add(Dense(10, activation='relu'))# Hidden 2
#model.add(Dense(10, activation='relu'))# Hidden 3
model.add(Dense(1)) # Output
model.compile(loss='mean_squared_error', optimizer='adam')

monitor = EarlyStopping(monitor='val_loss', min_delta=1e-3, patience=5, verbose=0, mode='auto')
model.fit(x_train,y_train,validation_data=(x_test,y_test),callbacks=[monitor],verbose=0,epochs=100)

model.save("model.h5")
print("Saved model to disk")

pred = model.predict(x_test)
# Measure MSE error.  
score = metrics.mean_squared_error(pred,y_test)
print("Final score (MSE): {}".format(score))

# Measure RMSE error.  RMSE is common for regression.
score = np.sqrt(metrics.mean_squared_error(pred,y_test))
print("Final score (RMSE):{}".format(score))

sys.stdout.write("\n")
sys.stdout.close()

