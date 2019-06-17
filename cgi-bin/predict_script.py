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

# load model
model = load_model('model.h5')

fs = cgi.FieldStorage()

#read the content inside a DataFrame object
df = pd.read_csv(filename_read,na_values=['NA','?'])

#dataset is an object of type numpy.ndarray
dataset=df.values
x=dataset[:,[0, 1, 2, 3, 4, 5, 6]] 
y=dataset[:,7] 

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

a = np.array([arr])
pred = model.predict(a)

for x in np.nditer(pred):
    val = x
arr = val.ravel()

result = {}
result['pred'] = json.dumps(int(round(arr[0].item())))  

sys.stdout.write(json.dumps(result,indent=1))
sys.stdout.write("\n")
sys.stdout.close()

