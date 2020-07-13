@extends('layouts.app')

@section('content')

        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1>
                    @if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif


                </h1>

                <div class="title m-b-md">

                    Factory Worldwide
                </div>
                <h3>Fullstack developer test</h3>
                <h1>Candidate: Milan Dimitrijevic</h1>

            </div>
        </div>
    </body>
</html>


@endsection
