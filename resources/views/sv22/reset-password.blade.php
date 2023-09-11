<x-admin-header :title="$title" :page_slug="$page_slug"> 

<div class="page-title">Change Your Password</div>

<form action="{{ $gen_class::$admin }}/reset-password/{{ auth()->user()->id }}" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">  

@csrf
@method('PUT')

<div>
<label for="password">New Password<span class="required">(atleast 5 characters)*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
<input type="password" name="password" id="password" class="form-control" placeholder="Your Password" required value="">
</div>
@error('password')
<p class="required">{{$message}}</p>
@enderror
</div>


<div>
<label for="password_confirmation">Retype Password<span class="required">*</span></label>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Retype Password" required value="">
</div>
@error('password_confirmation')
<p class="required">{{$message}}</p>
@enderror
</div>
                     
<div>
<button class="btn gen-btn float-right"><i class="fa fa-upload"></i> Update</button>
</div>
</form>

<script src="{{ asset('js/general-form.js') }}"></script>

</div>
</div>

</div>

</x-admin-header> 