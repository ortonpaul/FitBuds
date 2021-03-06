# Used to generate Support Vector Machines
# Chose SVM becuase of the large number of dimensions
import numpy as np
import pandas as pd
from sklearn import datasets, svm

dataframe = pd.read_csv("data/training_narrow.csv")
print(dataframe)

X = dataframe.drop(['Label'], axis=1)
y = dataframe['Label']

print(X)
print(y)

# Gamma has to be calculated this way for it to work with CoreML tools
# Python 2.7 Version
# clf = svm.SVC(gamma = 1.0/543.0)

# Python 3.7 Version (not compatible with coremltools)
clf = svm.SVC(gamma = 'scale')
clf.fit(X, y)

testingdata = pd.read_csv("data/testing_narrow.csv")
XTestingData = testingdata.drop(['Label'], axis=1)

print(XTestingData)
print(list(XTestingData))

print(clf.predict([XTestingData.loc[0, : ]]))

# import coremltools
# coreml_model = coremltools.converters.sklearn.convert(clf)
# coreml_model.save('narrow_model.mlmodel')