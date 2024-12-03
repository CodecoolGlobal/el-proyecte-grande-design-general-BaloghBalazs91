@extends('layout')

@section('title','Home')

@section('content')
    <div align="center">
    <img src="{{ asset('storage/images/home-picture.jpg') }}" alt="Gym Picture" class="w-75" >
    </div>
    <br>
    <h1 align="center">Welcome to our modern and well-equipped gym's website! We are proud to present a platform that caters to all fitness enthusiasts!</h1><br>
    <br>

        <h2 align="center">
        We offer modern and professional equipment to help you achieve your best form.
        Join us now and become part of a dynamic and supportive community focused on achieving both physical and mental balance!<br>
            <br>
        </h2>

        <h5 align="center">
        <a href="/user/profile">User Management:</a><br>
        Easily register and manage your user profile.<br>
            <br>

            <a href="/trainings">Appointment Booking:</a><br>
        Book appointments at your convenience and receive email notifications.<br>
            <br>

            <a href="/trainings">Appointment Cancellation:</a><br>
        Simple cancellation or modification of booked slots to fit your schedule.<br>
            <br>

        <a href="trainers">Trainer Overview and Ratings:</a><br>
        Get to know our trainers, read their profiles, and rate your sessions to help others find the best fit.<br>
            <br>
        </h5>






@endsection
