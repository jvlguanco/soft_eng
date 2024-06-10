<div class="pt-8 pl-6 pr-20">
    <section class="container px-4 mx-auto">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800">PLMAT Results</h2>

                    <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full">Total Applicants with Exam: </span>
                </div>
            </div>
        </div>

        <div class="gap-16 mt-6 md:flex md:items-center">
            <div class="w-1/3">
                Result Filter
            </div>
        </div>

        <div class="mt-6 md:flex md:items-center md:justify-between">
            <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg rtl:flex-row-reverse ">
                <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm {{$resultType == 'no' ? 'bg-gray-100' : 'hover:bg-gray-100'}}" onclick="window.location.href='{{ url()->current() }}?type=no'">
                    No Results Given
                </button>

                <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm {{$resultType == 'yes' ? 'bg-gray-100' : 'hover:bg-gray-100'}}" onclick="window.location.href='{{ url()->current() }}?type=yes'">
                    With Results
                </button>
            </div>

            <form action="{{ url()->current() }}" method="GET" class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                    <button type="submit" class="mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </span>

                <input type="text" placeholder="Search" name="searchResultApplicant" class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 focus:border-blue-400  focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                <input type="hidden" name="type" value="{{ $resultType }}">
            </form>
        </div>

        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Applicant No.
                                    </th>

                                    <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        Name
                                    </th>

                                    @if($resultType == 'yes')
                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                            Rank
                                        </th>

                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                            Score
                                        </th>

                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                            Course
                                        </th>

                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                            Remarks
                                        </th>
                                        
                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                            Confirmed Slot
                                        </th>
                                    @endif
                                    
                                    @if($resultType != 'yes')
                                        <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                            Actions
                                        </th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 ">
                                @foreach ($resultList as $applicant)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                        {{ $applicant->applicant_id }}
                                    </td>
                                    
                                    <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                        {{ $applicant->lastName }}, {{ $applicant->firstName }} {{ $applicant->middleName }} @if ($applicant->suffix != 'None') {{ $applicant->suffix }} @endif
                                    </td>

                                    @if($resultType != 'yes')
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <a href="{{ route('admin.set.result', ['currentRoute' => $currentRoute, 'applicationType' => $applicant->applicationType, 'applicantId' => $applicant->applicant_id]) }}" class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:rounded-full">
                                            <div class="inline px-3 py-1 text-sm font-normal text-gray-700 rounded-full gap-x-2 bg-gray-200/60">
                                                Add Result
                                            </div>
                                        </a>
                                    </td>
                                    @endif

                                    @if($resultType == 'yes')
                                        <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                            {{ $applicant->rank }}
                                        </td>

                                        <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                            {{ $applicant->score }}
                                        </td>

                                        <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                            @if($applicant->remark == 'with')
                                                {{ $applicant->courseOffer }}
                                            @endif
                                        </td>

                                        <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                            @if($applicant->remark == 'with')
                                                <span class="px-3 py-1 text-xs text-green-800 bg-green-100 rounded-md">
                                                    Passed with Course
                                                </span>
                                            @elseif($applicant->remark == 'without')
                                                <span class="px-3 py-1 text-xs text-yellow-800 bg-yellow-100 rounded-md">
                                                    Waitlisted
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-xs text-red-800 bg-red-100 rounded-md">
                                                    Failed
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                            @if($applicant->remark != 'failed')
                                                {{ ucfirst($applicant->confirmed) }}
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            {{ $resultList->appends(['resultType' => $resultType, 'searchResultApplicant' => $searchResultApplicant])->links() }}
        </div>

        <form action="{{ route('admin.generate.result', ['currentRoute' => $currentRoute]) }}" method="POST" target="__blank">
            @csrf
            <button type="submit" class="px-4 py-2 mt-4 text-white bg-blue-600 rounded-lg">Generate Report</button>
        </form>
    </section>
</div>

@if(session('setResult'))
    <script>
        alert('{{ session('setResult') }}');
    </script>
@endif