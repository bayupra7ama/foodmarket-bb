
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Transaction </title>
 
</head>
<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Transaction') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="border px-6 py-4">ID</th>
                            <th class="border px-6 py-4">Food</th>
                            <th class="border px-6 py-4">User</th>
                            <th class="border px-6 py-4">Quantity</th>
                            <th class="border px-6 py-4">Total</th>
                            <th class="border px-6 py-4">Status</th>
                            <th class="border px-6 py-4">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($transaction as $item)
                                <tr>
                                    <td class="border px-6 py-4"><p>{{ $item->id }}</p></td>
                                    <td class="border px-6 py-4 ">{{ $item->food->name }}</td>
                                    <td class="border px-6 py-4 ">{{ $item->user->name }}</td>
                                    <td class="border px-6 py-4">{{ $item->quantity }}</td>
                                    <td class="border px-6 py-4">{{ number_format($item->total) }}</td>
                                    <td class="border px-6 py-4">{{ $item->status }}</td>
                                    <td class="border px-6 py- text-center">
                                        <a href="{{ route('transaction.show', $item->id) }}" class="btn btn-primary">
                                            View
                                        </a>
                                        <form action="{{ route('transaction.destroy', $item->id) }}" method="POST" class="inline-block">
                                            {!! method_field('delete') . csrf_field() !!}
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                   <td colspan="6" class="border text-center p-5">
                                       Data Tidak Ditemukan
                                   </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-5">
                    {{ $transaction->links() }}
                </div>
            </div>
        </div>
    </x-app-layout>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

