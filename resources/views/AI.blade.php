<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10">

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- AI Request Form --}}
        <form action="{{ route('ai.process') }}" method="POST" class="mb-6">
            @csrf
            <div class="mb-4">
                <label for="prompt" class="block text-gray-700 font-bold mb-2">
                    Ask your question or request:
                </label>
                <textarea 
                    name="text" 
                    id="prompt" 
                    rows="4" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                    placeholder="Type your message here..."
                >{{ old('prompt') }}</textarea>
            </div>

            <button 
                type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200"
            >
                Send to AI
            </button>
        </form>

        {{-- AI Response Section --}}
        @isset($response)
            <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 mb-2">💬 AI Response:</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $response }}</p>
            </div>
        @endisset

    </div>
</x-app-layout>
