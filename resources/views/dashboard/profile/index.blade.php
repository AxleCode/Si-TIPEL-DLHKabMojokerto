@extends('dashboard.layouts.main')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
</head>
@section('container')


      @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      

<main class="content mb-7">
<div class="container rounded bg-white  ">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5 mb-3" width="150px" src="/img/user.png"><span class="font-weight-bold">{{ auth()->user()->name }}</span><span class="text-black-50"></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            
            <div class="p-3 py-5">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                  
                <form method="POST" action="/dashboard/profile" enctype="multipart/form-data" id="profile-form">
                    @csrf
                <!-- Email input -->
          <div class="form-outline mb-4 form-floating">
            <input hidden disabled type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="email" required value="{{ auth()->user()->email }} " id="email-input" @if(old('enable_disable', 0)) disabled @endif/>
            <label hidden class="form-label"  for="email">Email</label>

            <div class="form-check mt-1">
                <input hidden class="form-check-input" type="checkbox" name="enable_disable" id="enable-disable-checkbox" value="1" >
                <label hidden class="form-check-label" for="enable-disable-checkbox">
                    Centang disini untuk ubah email
                </label>
            </div>

            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror  
        </div>

        <script>
            const emailInput = document.getElementById('email-input');
            const enableDisableCheckbox = document.getElementById('enable-disable-checkbox');

            enableDisableCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    emailInput.removeAttribute('disabled');
                } else {
                    emailInput.setAttribute('disabled', '');
                }
            });

        </script>


          <!-- Nama input -->
          <div class="form-outline mb-4 form-floating">
            <input type="name" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="name" required value="{{ auth()->user()->name }}"/>
            <label class="form-label" for="name">Nama</label>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror  
          </div>

          <!-- Alamat input -->
          <div class="form-outline mb-4 form-floating">
            <input type="text" name="alamatpemohon" class="form-control form-control-lg @error('alamatpemohon') is-invalid @enderror" placeholder="alamatpemohon" required value="{{ auth()->user()->alamatpemohon }}"/>
            <label class="form-label" for="alamat">Alamat Pemohon</label>
            @error('alamatpemohon')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror  
          </div>

          <!-- No HP input -->
          <div class="form-outline mb-4 form-floating">
            <input type="number" name="nohp" class="form-control form-control-lg @error('nohp') is-invalid @enderror"  placeholder="nohp" required value="{{ auth()->user()->nohp }}"/>
            <label class="form-label" for="nohp">Nomor HP/WA</label>
            @error('nohp')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror  
          </div>
       
          <!-- Submit button -->
          <div class="text-center">
            <button id="profile-submit" type="submit" name="submit_type" value="profile" class="w-50 btn btn-lg btn-outline-primary">Ubah Profile</button>
          </div>
   

            </div>
        </form>
        </div>


     
        <div class="col-md-4">
           
            <form method="POST" action="{{ route('profile-update') }}" enctype="multipart/form-data">
                @csrf  
            <div class="p-3 py-5">
                @if(session()->has('successpass'))
                <div class="alert alert-success" role="alert">
                    {{ session('successpass') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-success" role="alert">
                    {{ session('error') }}
                </div>
            @endif
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Update Password</h4>
                </div>

                 <!-- Password Lama -->
                 <div class="form-outline mb-4 form-floating">
                    <input type="password" name="current_password" id="current_password" class="form-control form-control-lg @error('password') is-invalid @enderror"  placeholder="Password" required autocomplete="old-password">
                    <label class="form-label" for="current_password">Password Lama</label>
                    @error('current_password')
                    <div class="invalid-feedback">
                        <div>{{ $message }}</div>
                    @enderror 
                </div>

                 <!-- Password input -->
                <div class="form-outline mb-4 form-floating">
                    <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password"/>
                    <label class="form-label" for="password">Password</label>
                    @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror  
        </div>

         <!-- Confirm Password input -->
         <div class="form-outline mb-4 form-floating">
            <input type="password" id="password-confirm" name="password_confirmation" class="form-control form-control-lg" placeholder="Password" required autocomplete="new-password"/>
            <label class="form-label" for="password">Konfirmasi Password</label>
         
        </div>
        <!-- Submit button -->
        <div class="text-center">
            <button  id="password-submit" type="submit" name="submit_type" value="password" class="w-50 btn btn-lg btn-outline-primary">Ubah Password</button>
      </div>
                
            </div>
        </form>
        </div>
    </div>
</div>
<style>
.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 14px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

{{-- <script>
    // Listen for form submission event
    const form = document.querySelector('#profile-form');
    const submitButton = document.querySelector('#profile-submit');
    form.addEventListener('submit', function(e) {
      // Prevent the default form submission behavior
      e.preventDefault();
      // Display SweetAlert2 confirmation dialog
      Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to submit this form',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'No, cancel',
      }).then((result) => {
        if (result.isConfirmed) {
          // If user confirms, submit the form
          submitButton.disabled = true;
          form.submit();
        }
      });
    });
  </script> --}}

  
	

            

           
</main>

@endsection
	

	