<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    @include('dashboard.layouts.style')
</head>

<body>
        @include('dashboard.layouts.sidebar')

        <div class="flex flex-col flex-1 w-full">
            @include('dashboard.layouts.header')
            <main class="h-full pb-16 overflow-y-auto">
      
        @yield('content')
            </main>
        
    </div>
    
    </div>
</body>

</html>
