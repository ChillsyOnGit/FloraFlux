import requests
import os
import serial
import time

arduino_port = "COM4"
baud_rate = 9600
ser = serial.Serial(arduino_port, baud_rate)


def send_data(meting):
    key = "L!0SMZ%y8*F"
    url = "https://floraflux.chillsy.net/receive_data.php"
    productid = "b6c7d8e9f0"
    waterg = 0
    if int(meting) < 50:
        waterg = 10
    else:
        waterg = 0

    query = "INSERT INTO Meting(vochtigheid, waterGebruikt, product) VALUES (" + str(meting) +","+str(waterg)+",'" + productid + "');"
    data = {
        'sql': query,
        'key': key
    }

    try:
        # Send the POST request
        response = requests.post(url, data=data, verify=False)  # verify=False disables SSL certificate verification
        
        # Check if the request was successful
        if response.status_code == 200:
            return response.text
        else:
            print(f"Error: Received status code {response.status_code}")
            return None
    except requests.exceptions.RequestException as e:
        print(f"Error during the request: {e}")
        return None

while True:
    try:
        # Read data from Arduino
        if ser.in_waiting > 0:
            meting = ser.readline().decode('utf-8').strip()
            print(f"Received: {meting}")  
            response = send_data(meting)
            if response:
                print("Server Response:", response)

    except KeyboardInterrupt:
        print("Exiting...")
        break