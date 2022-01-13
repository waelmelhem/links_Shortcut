<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi <b>{{ Auth::user()->name }}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Link</h4>
                    </div>
                    <div class="card-body" style="padding: 16px">
                        <form method="post" action="{{ route('dashboard.update') }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label for="disabledTextInput">Edit Title</label>
                                    <input type="text" id="disabledTextInput" name="title" autocomplete="off"
                                        class="form-control" placeholder="Facebook" value="{{ $link->title }}">
                                </div>
                                <br>
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label for="disabledTextInput1">Edit Password</label><span class="text-info">
                                        (optional)</span>
                                    <input type="password" name="password" id="disabledTextInpu1" autocomplete="off"
                                        class="form-control" value="{{ $link->password }}">
                                </div>
                                <br>

                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Edit the link</label>
                                <input type="text" name="Real_Path" class="form-control" id="inputAddress"
                                    placeholder="www.facebook.com" value="{{ $link->Real_Path }}">
                            </div>
                            @error('Real_Path')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input value="{{ $link->New_Path }}" name="New_Path" hidden>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
