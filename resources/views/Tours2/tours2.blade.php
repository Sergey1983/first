@extends('layouts.master')

@section ('content')

@include('layouts.create_tour_button')

@include('layouts.tours2_table')

<?=dump($r); ?>;
<?=dump($tourist_nubmer); ?>;

@endsection