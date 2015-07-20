@extends('layouts.main')
@section('content') 

<style>
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        color: #B0BEC5;
        display: table;
        font-weight: 100;
        font-family: 'Lato';
    }

    .container {
        text-align: center;
        display: table-cell;
        vertical-align: middle;
    }

    .content {
        text-align: center;
        display: inline-block;
    }

    .title {
        font-size: 96px;
    }

    .quote {
        font-size: 24px;
    }

    a {
        margin-top: 10px;
    }
</style>
<div class="container">
    <div class="content">
        <div class="title">Laravel 5</div>
        <div class="quote">{{ Inspiring::quote() }}</div>
        <?php if(Auth::check()): ?>
            <a href="auth/logout" class="btn btn-danger" title="Logout">Logout</a>
        <?php else: ?>
            <a href="auth/register" class="btn btn-primary" title="Register">
                Register
            </a>
            <a href="auth/login" class="btn btn-primary" title="Login">
                Login
            </a>
        <?php endif; ?>
    </div>
</div>
    