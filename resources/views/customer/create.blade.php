@extends('layouts.app')

@section('content')
    <section class="login-register-area section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-register-content p-4 shadow">
                        <div class="mb-30">
                            <h4 class="page-header-title mb-4">Submit Feedback</h4>
                        </div>
                        <div class="billing-info-wrap">
                            <form method="POST" action="{{ route('user.store_feedback') }}">
                                @csrf
                                <div class="billing-info">
                                    <input type="text" name="title" placeholder="Title"
                                        class="@error('title') is-invalid @enderror" autofocus>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="billing-select">
                                    <div class="select-style">
                                        <select name="category" id="category"
                                            class="select-active @error('category') is-invalid @enderror mb-1">
                                            <option value="">Select</option>
                                            @forelse ($feedback_category as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @empty
                                                <option value="" disabled>No Category</option>
                                            @endforelse
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="additional-info-wrap">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        cols="30" rows="10" style="resize: none; border-radius: 0px;"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="submit_btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
