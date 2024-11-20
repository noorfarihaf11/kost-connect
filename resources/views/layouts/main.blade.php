<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    @include('layouts.style')
</head>

<body>
   
        <!-- Desktop sidebar -->
        @include('layouts.sidebar')

        <div class="flex flex-col flex-1 w-full">
            @include('layouts.header')
      
        @yield('content')
    </div>
    </div>
</body>

</html>
