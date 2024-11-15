<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    @include('dashboard.layouts.style')
</head>

<body>
   
        <!-- Desktop sidebar -->
        @include('dashboard.layouts.sidebar')

        <div class="flex flex-col flex-1 w-full">
            @include('dashboard.layouts.header')
      
        @yield('content')
    </div>
    </div>
</body>

</html>
