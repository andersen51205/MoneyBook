@extends('layouts.Backstage')

@section('main')
    {{-- 麵包屑 --}}
    @include('layouts._Breadcrumb', ['root' => '類別管理'])
    <div id="Div_category_list" class="d-none">
    </div>
    <div id="Div_category_form" class="">
    </div>
@endsection

@section('js')
<script>

</script>
@endsection
