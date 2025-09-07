@extends('auth.master2')

@section('content2')
<div class="contact-container vh-100 d-flex justify-content-center align-items-center">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-6">

            <!-- Card Wrapper -->
            <div class="contact-card card shadow-lg p-5 rounded-4 border-0">

                <h4 class="card-title mb-4 text-center fw-bold contact-title">Submit Your CV</h4>

                <form action="cv_file" method="post" class="php-email-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4">

                        <!-- File Input -->
                        <div class="col-md-12">
                            <label for="file_cv" class="form-label fw-semibold">Upload Your CV</label>
                            <input type="file" class="form-control form-control-lg" name="file_cv" id="file_cv" required>
                        </div>

                        <!-- Message -->
                        <div class="col-md-12">
                            <label for="message" class="form-label fw-semibold">Message</label>
                            <textarea class="form-control form-control-lg" name="message" id="message" rows="6" placeholder="Write a short message about you.." required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-green btn-lg px-5">
                                Send CV
                            </button>
                        </div>

                    </div>
                </form>
            </div>
            <!-- End Card Wrapper -->

        </div>
    </div>
</div>
@endsection
