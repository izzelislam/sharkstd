<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="market place asstes" />
    <title>Shark Std - Digital marketplace assets.</title>
    
    @include("main.layouts.style")
    @stack("addon-style")

</head>

<body>
    @include("main.layouts.navbar")
    <main role="main">

        @yield("content")

    </main>
    
    @include("main.layouts.footer")
    
    @include("main.layouts.script")
    @stack("addon-script")
</body>

</html>