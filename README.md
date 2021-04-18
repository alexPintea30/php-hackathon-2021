# PHP Hackathon
This document has the purpose of summarizing the main functionalities your application managed to achieve from a technical perspective. Feel free to extend this template to meet your needs and also choose any approach you want for documenting your solution.

## Problem statement
*Congratulations, you have been chosen to handle the new client that has just signed up with us.  You are part of the software engineering team that has to build a solution for the new client’s business.
Now let’s see what this business is about: the client’s idea is to build a health center platform (the building is already there) that allows the booking of sport programmes (pilates, kangoo jumps), from here referred to simply as programmes. The main difference from her competitors is that she wants to make them accessible through other applications that already have a user base, such as maybe Facebook, Strava, Suunto or any custom application that wants to encourage their users to practice sport. This means they need to be able to integrate our client’s product into their own.
The team has decided that the best solution would be a REST API that could be integrated by those other platforms and that the application does not need a dedicated frontend (no html, css, yeeey!). After an initial discussion with the client, you know that the main responsibility of the API is to allow users to register to an existing programme and allow admins to create and delete programmes.
When creating programmes, admins need to provide a time interval (starting date and time and ending date and time), a maximum number of allowed participants (users that have registered to the programme) and a room in which the programme will take place.
Programmes need to be assigned a room within the health center. Each room can facilitate one or more programme types. The list of rooms and programme types can be fixed, with no possibility to add rooms or new types in the system. The api does not need to support CRUD operations on them.
All the programmes in the health center need to fully fit inside the daily schedule. This means that the same room cannot be used at the same time for separate programmes (a.k.a two programmes cannot use the same room at the same time). Also the same user cannot register to more than one programme in the same time interval (if kangoo jumps takes place from 10 to 12, she cannot participate in pilates from 11 to 13) even if the programmes are in different rooms. You also need to make sure that a user does not register to programmes that exceed the number of allowed maximum users.
Authentication is not an issue. It’s not required for users, as they can be registered into the system only with the (valid!) CNP. A list of admins can be hardcoded in the system and each can have a random string token that they would need to send as a request header in order for the application to know that specific request was made by an admin and the api was not abused by a bad actor. (for the purpose of this exercise, we won’t focus on security, but be aware this is a bad solution, do not try in production!)
You have estimated it takes 4 weeks to build this solution. You have 2 days. Good luck!*

## Technical documentation
### Data and Domain model
The entities which I have chosen for the database are: booking, program, rooms and users.
The booking table maps the many-to-many relationship between programmes and users, 
therefore in addition to the two foreign keys to the respective tables we also have as columns startDate and EndDate for a booking.
The programmes table contains the type of program, the maximum number of users that can register with it,
 and a foreign key to the room table. The relationship between programmes and rooms is many-to-one because many programmes can be assigned to one room.
In the users table we have the following attributes: token and cnp for identification and isAdmin to check if a user is simple or administrator

### Application architecture
I chose to use object-oriented programming so for each entity in the database I created a class, 
except for the rooms table where it was not needed because it does not require CRUD operations.
In the constructors of these classes I made the connection with the database.
I also created methods inside the classes
which represent parts of the main functionalities of the application.
In each file I created instances of these classes and used the methods for validations.
###  Implementation
##### Functionalities
For each of the following functionalities, please tick the box if you implemented it and describe its input and output in your application:

[x] Brew coffee \
[ x] Create programme \
In the createBooking.php file I have realized this functionality which receives as input a json with the booking data and goes through certain validations until the booking is made.
[ x] Delete programme \
In the deleteBooking.php file I realized the functionality of deleting a booking by an administrator only, similar to the first functionality, previously described, I took the data from a json.
[ x] Book a programme 
I have incorporated this functionality in the one for creating booking, the administrator having the possibility to add a new programming as well.
[x]CreateUsers
Also, a simple user can register in the system if his data is validated.

##### Business rules
In general, the application is based on the validation of input data.
ore precisely, for the functionality of creating a booking, you must first check if the user 
is logged in to the system.
Then it must be checked whether its booking does not overlap with other bookings or with other types of bookings.
It must also be checked if there are still places available for the chosen type of booking.
These validations comply with the user requirements.

If we take as an example the registration of a new user then it will be validated according to the cnp in our database.
If an administrator wants to delete a user then he must be validated as an administrator in the database.
##### 3rd party libraries (if applicable)
Please give a brief review of the 3rd party libraries you used and how/ why you've integrated them into your project.

##### Environment
Please fill in the following table with the technologies you used in order to work at your application. Feel free to add more rows if you want us to know about anything else you used.
| Name | Choice |
| ------ | ------ |
| Operating system (OS) | Windows 10 Home |
| Database  | MySQL|
| Web server| Apache |
| PHP |  7.4.7 |
| IDE |  PhpStorm 2.2|

### Testing
If an administrator wants to delete a user then he must be validated as an administrator in the database.
I also chose the manual testing of the functionalities by displaying some messages or variables in certain functions
## Feedback
In this section, please let us know what is your opinion about this experience and how we can improve it:

1. Have you ever been involved in a similar experience? If so, how was this one different?
No,is the first time
2. Do you think this type of selection process is suitable for you?
Yes
3. What's your opinion about the complexity of the requirements?
Intermediate for my level of knowledge
4. What did you enjoy the most?
The Meetings :))
5. What was the most challenging part of this anti hackathon?
Time
6. Do you think the time limit was suitable for the requirements?
A little bit
7. Did you find the resources you were sent on your email useful?
I did not receive resources by email
8. Is there anything you would like to improve to your current implementation?
Yes,a lot of things
9. What would you change regarding this anti hackathon?
More time

