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
                        <h4>Generate new Link</h4>
                    </div>
                    <div class="card-body" style="padding: 16px">
                        <form method="post" action="{{route('dashboard.add')}}" autocomplete="off">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-4 col-sm-6">
                                    <label for="disabledTextInput">Title</label>
                                    <input type="text" id="disabledTextInput" name="title" autocomplete="off" class="form-control" placeholder="Facebook">
                                  </div>
                                  <br>
                                  <div class="form-group col-lg-4 col-sm-6">
                                    <label for="disabledTextInput1">Password</label><span class="text-info"> (optional)</span>
                                    <input type="password" name="password" id="disabledTextInpu1" autocomplete="off" class="form-control" >
                                  </div>
                                  <br>
                              
                            </div>
                            <div class="form-group">
                              <label for="inputAddress">Enter the link</label>
                              <input type="text" name="Real_Path" class="form-control" id="inputAddress" placeholder="www.facebook.com">
                            </div>
                            @error('Real_Path')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                          @if(session('New_Path'))
                                        <br>
                                        <h5>The new Link:</h5>
                                        <!-- The text field -->
                                        <div class="input-group w-50">
                                            
                                            
                                            
                                            <span class="input-group-text" id="basic-addon1">
                                                <button type="button" class="btn btn-outline-dark" onclick="myFunction()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"></path>
                                                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"></path>
                                                    </svg>
                                                     
                                                </button>
                                                 
                                                <input type="text" value="{{config('app.url').':8000'."/".session('New_Path')}}" id="myInput"
                                            style="width:420px;height:50px; background-color: #ffffff"
                                            aria-label="Input group example" aria-describedby="basic-addon1" class="form-control"
                                            readonly>
                                            </span>
                                            
                                            
                                          </div>
                                        <script>
                                            function myFunction() {
                                            /* Get the text field */
                                            var copyText = document.getElementById("myInput");

                                            /* Select the text field */
                                            copyText.select();
                                            copyText.setSelectionRange(0, 99999); /* For mobile devices */

                                            /* Copy the text inside the text field */
                                            navigator.clipboard.writeText(copyText.value);

                                            /* Alert the copied text */
                                            alert("Copied the text: " + copyText.value);
                                            }
                                            </script>
                                        @endif
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
