import sys
import cv2
import face_recognition
import pickle
import os
from flask import Flask, request, redirect
import numpy as np
import glob
import time
import csv
from datetime import datetime
import mysql.connector


app = Flask(__name__)


@app.route('/', methods=['GET', 'POST'])
def get_data():
	name = request.args.get("name")
	ref_id = request.args.get("ref_id")
	temp = face_rec(name,ref_id)
	return redirect("http://localhost/capstone/admin/faceRecord.php")

def face_rec(name, ref_id):

	try:
		f=open("ref_name.pkl","rb")

		ref_dictt=pickle.load(f)
		f.close()
	except:
		ref_dictt={}
	ref_dictt[ref_id]=name


	f=open("ref_name.pkl","wb")
	pickle.dump(ref_dictt,f)
	f.close()

	try:
		f=open("ref_embed.pkl","rb")

		embed_dictt=pickle.load(f)
		f.close()
	except:
		embed_dictt={}


	for i in range(5):
		key = cv2. waitKey(1)
		webcam = cv2.VideoCapture(0)
		while True:

			check, frame = webcam.read()
			# print(check) #prints true as long as the webcam is running
			# print(frame) #prints matrix values of each framecd
			cv2.imshow("Capturing", frame)
			small_frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)
			rgb_small_frame = small_frame[:, :, ::-1]

			key = cv2.waitKey(1)

			if key == ord('s') :
				face_locations = face_recognition.face_locations(rgb_small_frame)
				if face_locations != []:
					face_encoding = face_recognition.face_encodings(frame)[0]
					if ref_id in embed_dictt:
						embed_dictt[ref_id]+=[face_encoding]
					else:
						embed_dictt[ref_id]=[face_encoding]
					webcam.release()
					cv2.waitKey(1)
					cv2.destroyAllWindows()
					break
			elif key == ord('q'):
				print("Turning off camera.")
				webcam.release()
				print("Camera off.")
				print("Program ended.")
				cv2.destroyAllWindows()
				break
	f=open("ref_embed.pkl","wb")
	pickle.dump(embed_dictt,f)
	f.close()
	return name

@app.route('/inmaterecognition', methods=['GET', 'POST'])
def fac_detect():
	f=open("ref_name.pkl","rb")
	ref_dictt=pickle.load(f)         #ref_dict=ref vs name
	f.close()

	f=open("ref_embed.pkl","rb")
	embed_dictt=pickle.load(f)      #embed_dict- ref  vs embedding
	f.close()

	############################################################################  encodings and ref_ids
	known_face_encodings = []  #encodingd of faces
	known_face_names = []	   #ref_id of faces



	for ref_id , embed_list in embed_dictt.items():
		for embed in embed_list:
			known_face_encodings +=[embed]
			known_face_names += [ref_id]



	#############################################################frame capturing from camera and face recognition
	video_capture = cv2.VideoCapture(0)
	# Initialize some variables
	face_locations = []
	face_encodings = []
	face_names = []
	process_this_frame = True

	while True  :
		# Grab a single frame of video
		ret, frame = video_capture.read()

		# Resize frame of video to 1/4 size for faster face recognition processing
		small_frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)

		# Convert the image from BGR color (which OpenCV uses) to RGB color (which face_recognition uses)
		rgb_small_frame = small_frame[:, :, ::-1]

		# Only process every other frame of video to save time
		if process_this_frame:
			# Find all the faces and face encodings in the current frame of video
			face_locations = face_recognition.face_locations(rgb_small_frame)
			face_encodings = face_recognition.face_encodings(rgb_small_frame, face_locations)

			face_names = []
			for face_encoding in face_encodings:
				# See if the face is a match for the known face(s)
				matches = face_recognition.compare_faces(known_face_encodings, face_encoding)
				name = "Unknown"

				# # If a match was found in known_face_encodings, just use the first one.
				if True in matches:
					first_match_index = matches.index(True)
					name = known_face_names[first_match_index]
					temp = "http://localhost/capstone/inmate/permission.php?id="+name
					return redirect(temp)	
				# Or instead, use the known face with the smallest distance to the new face
				# face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
				# best_match_index = np.argmin(face_distances)
				# if matches[best_match_index]:
				# 	name = known_face_names[best_match_index]
					
				# face_names.append(name)
				print(face_names, end="")
				print(datetime.now())
		process_this_frame = not process_this_frame


		# Display the results
		for (top, right, bottom, left), name in zip(face_locations, face_names):
			# Scale back up face locations since the frame we detected in was scaled to 1/4 size
			top *= 4
			right *= 4
			bottom *= 4
			left *= 4

						  #updating in database

			cv2.rectangle(frame, (left, top), (right, bottom), (0, 0, 255), 2)

			# Draw a label with a name below the face
			cv2.rectangle(frame, (left, bottom - 35), (right, bottom), (0, 0, 255), cv2.FILLED)
			font = cv2.FONT_HERSHEY_DUPLEX
			cv2.putText(frame, ref_dictt[name], (left + 6, bottom - 6), font, 1.0, (255, 255, 255), 1)

		font = cv2.FONT_HERSHEY_DUPLEX
		# cv2.putText(frame, last_rec[0], (6,20), font, 1.0, (0,0 ,0), 1)

		# Display the resulting imagecv2.putText(frame, ref_dictt[name], (left + 6, bottom - 6), font, 1.0, (255, 255, 255), 1)
		cv2.imshow('Video', frame)
		# Hit 'q' on the keyboard to quit!
		if cv2.waitKey(1) & 0xFF == ord('q'):
			# t.cancel()
			break

			# break

	# Release handle to the webcam
	video_capture.release()
	cv2.destroyAllWindows()
	return 0



if __name__ == "__main__":
	app.run()
