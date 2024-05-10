# Sa7ty

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Class Diagram](#class-diagram)

## Introduction

Sa7ty is an innovative health platform designed to streamline the interaction between patients and healthcare providers. It facilitates easier access to medical services, enhances the efficiency of booking appointments, and aids in preliminary medical diagnostics through an intelligent chatbot. This project aims to simplify the healthcare process, making it more accessible and user-friendly for everyone involved.

## Features of the Sa7ty Project

- **Reservation System:** A user-friendly interface that allows patients to easily book and manage appointments with healthcare providers. The system displays available slots in real-time and provides immediate booking confirmation.

- **Doctor List:** Features a comprehensive list of qualified doctors categorized by specialty and location. Each doctor's profile includes qualifications, reviews, and availability, helping patients choose the healthcare professional that best fits their needs.

- **Chatbot Disease Detection:** An advanced chatbot that analyzes user-input symptoms to suggest possible medical conditions. This tool helps users make informed decisions about when to seek medical attention and provides educational content on various health issues.

## Installation

Ensure you have PHP, Composer, and Symfony installed on your system to set up the Sa7ty project. Follow these steps:

1. **Install Security Bundle**
   ```bash
   composer require symfony/security-bundle
   ```

2. **Create the Database**
   ```bash
   symfony console doctrine:database:create
   ```

3. **Install Dependencies**
   ```bash
   composer install
   ```

4. **Create Migration**
   ```bash
   symfony console make:migration
   ```

5. **Migrate the Database**
   ```bash
   symfony console doctrine:migrations:migrate
   ```

6. **Load Fixtures**
   ```bash
   symfony console doctrine:fixtures:load
   ```

7. **Start the Server**
   ```bash
   symfony server:start
   ```

## Class Diagram

Below is the class diagram for the Sa7ty project, detailing the structure and relationships between the classes:

![Sa7ty Class Diagram](https://github.com/Mk-1000/sa7ty/assets/86926622/d747937c-d3ba-47b4-b2f3-28a972ff9853)

## Chat System Screenshot

Below is a screenshot of the Chat System in the Sa7ty project, showcasing an example interaction with a user. This illustrates how the chatbot intelligently processes user symptoms and provides potential diagnoses and precautions:

![Chatbot Interaction](https://github.com/Mk-1000/sa7ty/blob/main/public/assets/upload/chat-bot.png)


