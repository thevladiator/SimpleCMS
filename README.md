# SimpleCMS

## Description
**SimpleCMS** is a static blog generator that allows you to create and manage a static blog with ease. It works with straight files containing HTML markup as the content input but without the burden of creating full HTML structure tags. It only needs HTML formatting tags.
A json file database contains the structure of the site with classic blog constructs like: **Categories** and **Tags**.

## User Flow
The goal of **static** blog is to allow the user to focus on creating content using only formatting HTML tags without any other structural tags or links to categories and tags.
After an article is properly formatted, the user enters the title, slug, category and tags in the json file that serves as its database. There's no need for any database engine to be installed. **SimpleCMS** uses only text files.
Then the user runs **SimpleCMS** generator which creates all properly formatted HTML files which now contain links to Category and Tag pages.


## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Contact Information](#contact-information)

## Installation
To install `SimpleCMS`, follow these steps:

1. Clone the repository:
  - git clone https://github.com/thevladiator/SimpleCMS.git
  - upload the SimpleCMS folder to your website

2. Directory structure:
  - SimpleCMS
    - admin
        index.html // admin index. This is the entry point of the application
    - config
      - config.properties // config the locations for your content and production site
    - content
      - articles // this is for your content
      - database // this is the json file for linking the content
    - database
      - articles-db.json // this is your database
    - media // all your media files
    - pages // these are your pages
    - generator
      - components // various template components
      - config // configuration object created from config.properties
      - domain // these are the domain objects
      - generators // site generator scripts
      - styles // style sheet which will be copied to the site
      - templates // templates
      - utils // common utilities

3. Usage:
  - Edit config/Config.php with the correct values for all the variables.
  - Add articles to /content/articles, properly formatted with HTML formatting tags.
  - Edit database/articles-db.json with Categories and Tags and an entry for each article.
  - Access index.html and press Generate Site link. This will create all static html files and place them in SITE_ROOT
