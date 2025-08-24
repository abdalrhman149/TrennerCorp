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

                            <div class="contact-form">
                                <div class="contact-form">
                                    <form method="post" action="/storejob">
                                        @csrf
                                        <p>

                                            <input type="text" placeholder="Job Title" name="title"
                                                value="{{ old('title') }}" style="width:100%">
                                            <span class="text-danger">
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </p>

                                        <p>
                                            <input type="text" placeholder="Category" name="category"
                                                value="{{ old('category') }}" style="width:100%">
                                            <span class="text-danger">
                                                @error('category')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </p>

                                        <p>
                                            <input type="text" placeholder="Requirements" name="requirements"
                                                value="{{ old('requirements') }}" style="width:100%">
                                            <span class="text-danger">
                                                @error('requirements')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </p>

                                        {{-- <p>//// this line for company auth////
                                    <select name="company_id" style="width:100%">
                                        <option value="">-- Select Company --</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('company_id') {{ $message }} @enderror</span>
                                </p> --}}

                                        <p>
                                            <input type="number" min="1" max="50" placeholder="Persons Needed"
                                                name="person_need" value="{{ old('person_need') }}" style="width:100%">
                                            <span class="text-danger">
                                                @error('person_need')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </p>

                                        <p>
                                            <input type="submit" value="Submit" class="btn btn-primary">
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
