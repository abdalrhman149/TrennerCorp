@extends('master')

@section('content1')
    <section id="courses" class="courses section"> <!-- Section Title -->
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <p>Popular Trening</p>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row">
                @forelse ($jobs as $job)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in"
                        data-aos-delay="100">
                        <div class="course-item"> <img src="{{ asset($job->company->imagepath) }}" class="img-fluid"
                                alt="...">
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="category">{{ $job->category }}</p>
                                </div>
                                <h3><a>Experiences: {{ $job->requirements }}</a>
                                    <div style="text-align: right; margin-top: 20px;"> <a
                                            href="{{ url('detail/' . $job->id) }}" class="btn-link">more..</a> </div>
                                </h3>
                                <p class="description">{{ $job->title }}</p>
                                <div class="trainer d-flex justify-content-between align-items-center">
                                    <div class="trainer-profile d-flex align-items-center"> <em> Company:
                                            {{ $job->company->name ?? 'No company assigned' }}</em> </div>
                                    <div class="trainer-rank d-flex align-items-center"> <i
                                            class="bi bi-person-fill user-icon"></i>&nbsp;{{ $job->person_need }} </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- End Course Item-->
                @endforeach
            </div> <!-- Pagination -->
            <div class="pagination-wrap d-flex justify-content-center mt-4">
                {{ $jobs->links('vendor.pagination.custom-modern') }} </div>
        </div>
    </section>
@endsection
