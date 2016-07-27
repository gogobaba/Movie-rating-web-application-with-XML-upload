# Movie Rating Web Application with XML upload
Web page that you can use to Upload Content in the form of an XML file, upload the parsed movies to a database and retrieve them, along with a rating system and leaderboard

## Prerequisites

What you need to have installed before

```
You will need server environment (local or public) that supports PHP, Apache and MySQL. For the 
testing of the web application I used MAMP with all default settings. 

Please see connection.php (public_html -> connection.php) and update $DBServer, $DBUser, $DBPass 
accordingly. I have them set as the default values.
```

Browser Compatibility
```
Tested with Safari 9 in El Capitan and Chrome, Macbook OS X 10.11 - should work fine in other 
browsers/operating systems too.
```

![Alt text](/images/screen1.png)

## Instructions

1. Download the repository as a zip.
2. Extract to a folder

```
The below instructions are for MAMP but you are welcome to use any other local or public server environment
```
3. Download MAMP http://www.mamp.info
4. An existing ‘htdocs’ folder should be moved to /Applications/MAMP
5. Copy contents for the extracted folder to ‘htdocs’ folder from step 4
6. Run MAMP and it’s server and go to localhost on your browser which should show the ‘index.php’ page.

## Upload XML File

The upload system works with XML's of the following format

```
Programmes 
-> Programmes id = "#"
	-> name
	-> description
	-> rating_score
	-> rating_submitted
	-> image_path
```

## Leaderboard 

![Alt text](/images/screen2.png)

**Mihai Dogaru**

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

