@props(['title' => null, 'description' => null, 'image' => null, 'type' => 'website'])

@php
    $fullTitle = $title ? "$title | Ordik ERP" : 'Ordik ERP: sistema de gestão para pequenas e médias empresas';
    $canonical = url()->current();
    $image = url($image ?? '/images/og-default.png');
@endphp

<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="Ordik ERP">
<meta property="og:locale" content="pt_BR">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
