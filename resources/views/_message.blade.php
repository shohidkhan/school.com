@if(!empty(session("success")))
    <div class="alert alert-success alert-dismissible " role="alert">
        {{ session("success") }}
    </div>
@endif
@if(!empty(session("error")))
    <div class="alert alert-danger alert-dismissible " role="alert">
        {{ session("error") }}
    </div>
@endif
@if(!empty(session("payment-error")))
    <div class="alert alert-error alert-dismissible " role="alert">
        {{ session("payment-error") }}
    </div>
@endif
@if(!empty(session("warning")))
    <div class="alert alert-warning alert-dismissible " role="alert">
        {{ session("warning") }}
    </div>
@endif
@if(!empty(session("info")))
    <div class="alert alert-info alert-dismissible " role="alert">
        {{ session("info") }}
    </div>
@endif
@if(!empty(session("secondery")))
    <div class="alert alert-secondery alert-dismissible " role="alert">
        {{ session("secondery") }}
    </div>
@endif
@if(!empty(session("primary")))
    <div class="alert alert-primary alert-dismissible " role="alert">
        {{ session("primary") }}
    </div>
@endif
@if(!empty(session("light")))
    <div class="alert alert-primary alert-dismissible " role="alert">
        {{ session("light") }}
    </div>
@endif