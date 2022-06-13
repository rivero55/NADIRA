# Nadira - Natural Disaster Reporting Application [C22-PS345]
<p align="center">
  <img src="Logo/nadira_logo.png" width="350" alt="nadira">
</p>

## Introduction

Based on geographical, geological, hydrological, and demographic conditions, the territory of Indonesia has conditions that allow disasters to occur, whether caused by natural factors, non-natural factors and human factors. Experience so far, natural disasters have caused human casualties, environmental damage, property losses, and psychological impacts which in certain circumstances can hinder development.

Demands in handling the impact of disasters, both in order to help victims and repair infrastructure and others require fast time so as not to lose momentum and handling can be carried out accurately, and community activities recover quickly.

BPBD (Badan Penanggulangan Bencana Daerah) is the authorized agency in handling disaster events, however, reporting of disaster events is still done manually. Less effective for people who need help quickly. Communities need a quick response to natural disasters and need practical reporting to make it easier for people to get help as soon as possible.

NADIRA (Natural Disaster Reporting Application) was formed from the community’s need to report disaster incidents easily and quickly. Using NADIRA anyone can report disaster incidents anywhere and anytime. It is more flexible and efficient.

## Built with

* Android Studio
* Google Cloud Platform Services
* Kotlin Programming Language
* Python Programming Language
* TensorFlow & Keras
* CNN Algorithm
* Laravel Framework

## Installation

1. Download the APK
2. Install the APK

## How to report a Natural Disaster

1. Login to Nadira with registered account
2. Choose "Kirim Laporan Bencana" in Home
3. Take a picture or get from your library picture of the natural disaster, e.g. Flood, land slide, wildfire, etc
4. Select one of the available categories and choose the incident point (if your selected image are correct to the model prediction u can proceed to the next step)
5. Fill in the address details and incident details
6. Checklist "Izinkan Laporan ini Diakses Publik?"
7. Click "Kirim Laporan" button, the report will be recorded by the system

## Implementation

* Machine Learning: Building machine learning models using TensorFlow using deep learning CNN algorithm, using data pipeline to serve the models, optimize the model and preprocessing the image data by changing the base color of each image to RGB and resizing the image to 224 x 224 pixel. Using transfer learning from Xception and tune the model to help classifying image.
* Android: Creating Android Project with Google Maps API integration for asscessing the User’s Location and using MVVM architecture, accessing the ML model and another service using API, and implement it in the Android Studio.
* Cloud: Setting up API with Laravel framework, deploying API using web server Nginx, and setting up environment needed. Also, configure Mariadb database so it can connect with API.

## Implementation of Machine Learning

1. Download dataset and unzip it
2. Split the dataset into training and testing
3. Data Preprocessing
4. Make a training and testing batch using train generator
5. Train 4 types of data in the Earthquake, Flood, Wildfire, and Cyclone images dataset using CNN Model which contains 3 Layers
6. Cleaning dataset to make sure the prediction accuracy more accurate and increase the accuracy
7. Improve the model with transfer learning with Xception 
8. Save the model weight and .json
9. From the saved model, convert it into tensorflowlite

## Members

* Rivero Novelino (M2012G1197)
* Patricia Melissa Yolanda Sibarani (M2114F1447)
* Sasvita Gevi Meliyasar (A2008G0847)
* Faisal Arsyad (A7335H2869)
* Dwi Rahmadina (C2005F0456)
* Rizal Nur Faizi (C2012G1264)
