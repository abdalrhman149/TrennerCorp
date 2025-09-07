@extends('master')

@section('content1')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Add</span> Job</h3>
                    </div>
                </div>
            </div>

            <div class="contact-from-section mt-150 mb-150">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mb-5 mb-lg-0">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="post" action="/storejob">
                                @csrf

                                <p>
                                    <input type="text" placeholder="Job Title" name="title" value="{{ old('title') }}"
                                        class="form-control">
                                    <span class="text-danger">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>

                                <p>
                                    <input type="text" placeholder="Category" name="category"
                                        value="{{ old('category') }}" class="form-control">
                                    <span class="text-danger">
                                        @error('category')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>

                                <p>
                                    <input type="text" placeholder="Requirements" name="requirements"
                                        value="{{ old('requirements') }}" class="form-control">
                                    <span class="text-danger">
                                        @error('requirements')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>

                                <!-- الشركة الحالية (مخفية) -->
                                <input type="hidden" name="company_id" value="{{ auth()->user()->id }}">

                                <p>
                                    <input type="number" min="1" max="50" placeholder="Persons Needed"
                                        name="person_need" value="{{ old('person_need') }}" class="form-control">
                                    <span class="text-danger">
                                        @error('person_need')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>

                                <p>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </p>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
