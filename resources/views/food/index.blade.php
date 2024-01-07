 
 
 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Food') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5">
                
                <a href="{{route('food.create')}}" class="bg-green-700 btn">
                   + Create Food
                </a>
            </div>
            <div class="bg-white">
                <table class="table-auto w-full">
                    <thead>
                        <th class="border px-6 py-4">ID</th>
                        <th class="border px-6 py-4">Name</th>
                        <th class="border px-6 py-4">Price</th>
                        <th class="border px-6 py-4">Rate</th>
                        <th class="border px-6 py-4">Types</th>
                        <th class="border px-6 py-4">Action</th>
                    </thead>

                    <tbody>
                        @forelse ( $food as $data )
                            
                       <tr>
                        <td class="border px-6 py-4">{{ $data->id }}</td>
                        <td class="border px-6 py-4">{{ $data->name }}</td>
                        <td class="border px-6 py-4">{{ number_format($data-> price)  }}</td>
                        <td class="border px-6 py-4">{{ $data->rate }}</td>
                        <td class="border px-6 py-4">{{ $data->types }}</td>
                        <td class="border px-6 py-4 text-center"><a  href="{{ Route('food.edit',$data->id) }}">Edit | </a>
                        <form action="{{ Route('food.destroy',$data->id) }}" method="POST" class="inline-block">
                        {!! method_field('delete') . csrf_field() !!}
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded">hapus</button>
                        </form>
                        </td>

                        @empty
                        <tr>
                            <td>
                                <td colspan="3" class="border text-center p-5">data tidak di temukan</td>
                            </td>
                        </tr>
                            
                        @endforelse
                    </tr>
                    </tbody>
                </table>

               
            </div>
            <div class="text-center mt-5">{{ ($food->links()) }}</div>
        </div>
    </div>
</x-app-layout>
