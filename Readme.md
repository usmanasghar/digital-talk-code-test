# My Views about the code

1) Code is developed using repository design pattern for better readability and maintainability.
2) Code is related to booking management. Means using the code we can create, update, list, accept booking, cancel
   booking, re-open booking and many other function can be performed related to bookings management.

# Good about Code

1) It is good that repository pattern is used for development.It increases readability, readability and different type
   of logics on different places.
2) Short and self-explanatory functions in BookingController

# What it makes Amazing Code

1) env attributes/keys are directly defined, it should be defined in config file for better code maintainability.
2) There does not seem to be any input validation for the request data. It is essential to validate user input to ensure
   it meets expected criteria.
3) Some common functions should be defined in relevant files. eg. isAdmin and isSuperAdmin should be define in User
   model.
4) Proper error handling prevent the code from unexpected breakage.
5) Proper conditional complexity handling, eg. many places else is not defined.
6) It would make better if there is HTTP response status code is defined for response.
7) Proper comments for each function functionality. better for code understanding
8) Proper variable naming convention. For better readability.
9) Define function return type and arguments type.
10) Many functions could be extracted inside BookingRepository for better readability and reusability.
11) Write unit test code for each function.
12) Handle undefined variable. Means give default values to variable.
13) Some code could be defined in separate services

# What is makes terrible code

1) No input form handling
2) Conditional complexity.
3) No http response status code defined in response.
4) Comments are not added about functionality.
5) Proper and consistent variable naming.
6) Undefined variables
7) Dockblock missing on some functions.

# What I have done

1) I have refactored the code and added comments on top of each function
2) Also I have written the unit tests in tests/unit folder for both functions.
3) I have modified all functions in BookingController and some functions in BookingRepository


