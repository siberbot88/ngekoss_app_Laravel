@extends('layouts.app')
@section('content')
<div id="Background"
    class="absolute top-0 w-full h-[280px] rounded-bl-[75px] bg-[linear-gradient(180deg,#F2F9E6_0%,#D2EDE4_100%)]">
</div>
<div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
    <div class="flex flex-col gap-1">
        <p>Good day,</p>
        <h1 class="font-bold text-xl leading-[30px]">Explore Cozy Home</h1>
    </div>
    <a href="#" class="flex items-center justify-center w-12 h-12 overflow-hidden bg-white rounded-full shrink-0">
        <img src="assets/images/icons/notification.svg" class="w-[28px] h-[28px]" alt="icon">
    </a>
</div>
@endsection
