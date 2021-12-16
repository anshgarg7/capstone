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
import json
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="jail"
)
mycursor = mydb.cursor()

app = Flask(__name__)


@app.route('/')
def route_rec():
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
	video_capture1 = cv2.VideoCapture(0)
	video_capture2 = cv2.VideoCapture(1)

	# Initialize some variables
	face_locations = []
	face_encodings = []
	face_names = []
	process_this_frame = True
	seen_face = []
	while True  :
		# Grab a single frame of video
		ret1, frame1 = video_capture1.read()
		ret2, frame2 = video_capture2.read()

		# Resize frame of video to 1/4 size for faster face recognition processing
		small_frame1 = cv2.resize(frame1, (0, 0), fx=0.25, fy=0.25)
		small_frame2 = cv2.resize(frame2, (0, 0), fx=0.25, fy=0.25)

		# Convert the image from BGR color (which OpenCV uses) to RGB color (which face_recognition uses)
		rgb_small_frame1 = small_frame1[:, :, ::-1]
		rgb_small_frame2 = small_frame2[:, :, ::-1]
		
		# Only process every other frame of video to save time
		if process_this_frame:
			# Find all the faces and face encodings in the current frame of video
			face_locations1 = face_recognition.face_locations(rgb_small_frame1)
			face_locations2 = face_recognition.face_locations(rgb_small_frame2)
			face_encodings1 = face_recognition.face_encodings(rgb_small_frame1, face_locations1)
			face_encodings2 = face_recognition.face_encodings(rgb_small_frame2, face_locations2)
			
			
			rec_frame = [[]]
			
			for face_encoding in face_encodings1:
				# See if the face is a match for the known face(s)
				face_names1 = []
				
				matches = face_recognition.compare_faces(known_face_encodings, face_encoding)
				name = "Unknown"

				# # If a match was found in known_face_encodings, just use the first one.
				# if True in matches:
				#     first_match_index = matches.index(True)
				#     name = known_face_names[first_match_index]

				# Or instead, use the known face with the smallest distance to the new face
				face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
				best_match_index = np.argmin(face_distances)
				if matches[best_match_index]:
					name = known_face_names[best_match_index]
				
				face_names1.append(name)
				face_names1.append(str(datetime.now()))
				face_names1.append('1')
				
				if name+'1' not in seen_face:
					seen_face.append(name+'1')
					rec_frame.append(face_names1)
					inmateID1 = face_names1[0]
					sql11 = "SELECT `id`,`sourceId`,`destinationId` FROM `routes` WHERE `inmateId` = "+inmateID1+" AND `enabled`='1'"
					mycursor.execute(sql11)
					myresult = mycursor.fetchone()
					routeID1 = myresult[0]
					sourceID1 = str(myresult[1])
					destinationID1 = str(myresult[2])
					# print(sourceID1)
					# print(destinationID1)
					# print(routeID1)
					sql111 = "SELECT `camera` FROM `routecameramap` WHERE `sourceId` = "+sourceID1+" AND `destinationId` = "+destinationID1
					mycursor.execute(sql111)
					myresult11 = mycursor.fetchall()
					cameralist = []
					for camera in myresult11:
						camerastring = camera[0]
						cameranumber = camerastring[-4]
						cameralist.append(cameranumber)
					
					cameraID = face_names1[2]
					if cameraID in cameralist:
						sql1111 = "UPDATE `routes` SET `enabled`='0' WHERE `id`="+str(routeID1)
						mycursor.execute(sql1111)
						mydb.commit()

					serialized_data = json.dumps(face_names1)
					sql1 = "INSERT INTO `journeydata`(`routeID`, `journeyArray`) VALUES (%s,%s)"
					values = (routeID1,serialized_data)
					mycursor.execute(sql1,values)
					mydb.commit()

				

			for face_encoding in face_encodings2:
				face_names2 = []
				# See if the face is a match for the known face(s)
				matches = face_recognition.compare_faces(known_face_encodings, face_encoding)
				name = "Unknown"

				# # If a match was found in known_face_encodings, just use the first one.
				# if True in matches:
				#     first_match_index = matches.index(True)
				#     name = known_face_names[first_match_index]

				# Or instead, use the known face with the smallest distance to the new face
				face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
				best_match_index = np.argmin(face_distances)
				if matches[best_match_index]:
					name = known_face_names[best_match_index]
				
				face_names2.append(name)
				face_names2.append(str(datetime.now()))
				face_names2.append('2')
				if name+'2' not in seen_face:
					seen_face.append(name+'2')
					rec_frame.append(face_names2)
					inmateID2 = face_names2[0]
					sql12 = "SELECT `id`,`sourceId`,`destinationId` FROM `routes` WHERE `inmateId` = "+inmateID2+" AND `enabled`='1'"
					mycursor.execute(sql12)
					myresult2 = mycursor.fetchone()
					routeID2 = myresult2[0]
					sourceID2 = str(myresult[1])
					destinationID2 = str(myresult[2])
					sql222 = "SELECT `camera` FROM `routecameramap` WHERE `sourceId` = "+sourceID2+" AND `destinationId` = "+destinationID2
					mycursor.execute(sql222)
					myresult22 = mycursor.fetchall()
					cameralist = []
					for camera in myresult22:
						camerastring = camera[0]
						cameranumber = camerastring[-4]
						cameralist.append(cameranumber)
					
					cameraID = face_names2[2]
					if cameraID in cameralist:
						sql2222 = "UPDATE `routes` SET `enabled`='0' WHERE `id`="+str(routeID2)
						mycursor.execute(sql2222)
						mydb.commit()


					serialized_data1 = json.dumps(face_names2)
					sql2 = "INSERT INTO `journeydata`(`routeID`, `journeyArray`) VALUES (%s,%s)"
					values1 = (routeID2,serialized_data1)
					mycursor.execute(sql2,values1)
					mydb.commit()
			rec_frame.pop(0)	
			print(rec_frame)

		process_this_frame = not process_this_frame


		# Display the results
		# for (top, right, bottom, left), name in zip(face_locations1, face_names1):
		# 	# Scale back up face locations since the frame we detected in was scaled to 1/4 size
		# 	top *= 4
		# 	right *= 4
		# 	bottom *= 4
		# 	left *= 4

		# 	              #updating in database

		# 	cv2.rectangle(frame1, (left, top), (right, bottom), (0, 0, 255), 2)

		# 	# Draw a label with a name below the face
		# 	cv2.rectangle(frame1, (left, bottom - 35), (right, bottom), (0, 0, 255), cv2.FILLED)
		# 	font = cv2.FONT_HERSHEY_DUPLEX
		# 	cv2.putText(frame1, ref_dictt[name], (left + 6, bottom - 6), font, 1.0, (255, 255, 255), 1)
		
		#font = cv2.FONT_HERSHEY_DUPLEX
		# cv2.putText(frame, last_rec[0], (6,20), font, 1.0, (0,0 ,0), 1)

		# Display the resulting imagecv2.putText(frame, ref_dictt[name], (left + 6, bottom - 6), font, 1.0, (255, 255, 255), 1)
		
		cv2.imshow('Video1', frame1)
		cv2.imshow('Video2', frame2)
		
		# Hit 'q' on the keyboard to quit!
		if cv2.waitKey(1) & 0xFF == ord('q'):
			# t.cancel()
			break

			# break

	# Release handle to the webcam
	video_capture1.release()
	video_capture2.release()

	cv2.destroyAllWindows()


@app.route('/encode', methods=['GET', 'POST'])
def get_data():
	name = request.args.get("name")
	ref_id = request.args.get("ref_id")
	temp = face_rec(name,ref_id)
	sql = "UPDATE `inmatedetails` SET `enabled`='1' WHERE `id` = "+ref_id
	mycursor.execute(sql)
	mydb.commit()
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
