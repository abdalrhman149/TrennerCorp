@extends('master')

@section('content1')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Job Details</h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Job Details</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Courses Course Details Section -->
        <section id="courses-course-details" class="courses-course-details section py-5">

            <div class="container" data-aos="fade-up">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <img src="{{ asset($job->company->imagepath) }}" class="img-fluid rounded shadow"
                            alt="Company Image">
                    </div>

                    <div class="col-lg-4">
                        <div class="course-info d-flex justify-content-between align-items-center border-bottom py-2">
                            <h5>Company</h5>
                            <p class="mb-0"><a href="#"
                                    class="text-decoration-none fw-semibold">{{ $job->company->name }}</a></p>
                        </div>
                         <div class="course-info d-flex justify-content-between align-items-center border-bottom py-2">
                            <h5>Category</h5>
                            <p class="mb-0">{{ $job->category }}</p>
                        </div>

                        <div class="course-info d-flex justify-content-between align-items-center border-bottom py-2">
                            <h5>Available Seats</h5>
                            <p class="mb-0">{{ $job->person_need }}</p>
                        </div>

                        <div class="course-info d-flex justify-content-between align-items-center border-bottom py-2">
                            <h5>Schedule</h5>
                            <p class="mb-0">To be announced</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Job Title and Button Section -->
        <div class="container my-5 text-center" data-aos="fade-up" data-aos-delay="100">
            <h2 class="display-5 fw-bold text-dark mb-3">{{ $job->title }}</h2>
            <p>{{ $job->title }}</p>
            <form action="/main" method="GET">
                <button type="submit" class="btn btn-green btn-lg px-5">
                    Accept
                </button>
            </form>
        </div>
    </main>
@endsection
