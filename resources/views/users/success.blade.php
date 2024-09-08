 @if (Session::get('success'))
     <div class="alert alert-success alert-dismissable">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Success!</strong> {{ Session::get('success') }}
     </div>
 @endif
 @if (Session::get('error'))
     <div class="alert alert-danger alert-dismissable">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Wrong!</strong> {{ Session::get('error') }}
     </div>
 @endif
