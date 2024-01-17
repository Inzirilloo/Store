<!DOCTYPE html>
<html>


<body>
    
    @if($errors->any())
    @foreach($errors->all() as $error)
    {{ $error }}
    @endforeach
    @endif
    {{-- qua uso comandi che riguardano lo user loggato --}}
    <h2>Benvenenuto: {{auth()->user()->name}}</h2>

    <a href="{{ route('admin.index') }}">
        <button type="submit">
            Se sei un admin schiacciami
        </button>
    </a>


    <br>
    <br>
    <form action="{{route('create') }}" method="GET">
        <button type="submit">
        Schiaccia per creare un nuovo products
        </button>
    </form>
    <br>
    <br>

    {{-- qua uso comandi che riguardano lo tutti i products e chi li ha productsati grazie alla foregin key
         e che ho obbligato il fatto che ogni products deve avere uno user che lo pubblica e lil user 
         DEVE esistere lo checcko tramite il metodo Role::exists (tutto questo nel controller) --}}
    @foreach($products as $product)
    id [{{ $product->id }}]

    nome [{{ $product->name }}]
    
    content [{{ $product->content }}]

    prezzo [{{ $product->price }}]
    {{-- posso farlo perche ho fatto fatto belongsto nel modello products --}}
    {{-- e anche perche ho fatto with('user') nel return view --}}
    pubblicato da [{{ $product->user->name }}]

    <br>
    <br>
    <!-- questo era quello che mettevo nella rotta o nel controller 
        mettendolo qua è piu sicuro cosi non arriva nemmeno al controller-->
{{--@if (Gate::allows('edit-products', $products)) 
    <form action="{{ route('edit', $products) }}" method="GET" >
        <button type="submit">
            Edit
        </button>
    </form>
    <form action="{{ route('destroy', $products) }}" method="products" >
        @csrf
        @method('DELETE')
        <button type="submit">
            Delete
        </button>
    </form>
@else
--}}
<a href="{{ route('edit', $product) }}">
    <button type="submit">
        Edit
    </button>
</a>
<form action="{{ route('destroy', $product) }}" method="POST" >
    @csrf
    @method('DELETE')
    <button type="submit">
        Delete
    </button>
</form>
{{--@endif--}}
    
    <hr>

    @endforeach
    <br>
    <br>
    {{--<p>If you click the "Submit" button, the form-data will be sent to a page called "login".</p>--}}
<form action="{{route('logout') }}" method="GET">
        <button type="submit">
        Schiaccia per logout
        </button>
    </form>

    
</body>

</html>