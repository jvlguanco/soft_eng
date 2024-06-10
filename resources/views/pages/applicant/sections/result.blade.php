<div class="flex items-center justify-center w-auto py-8 pr-8">
        @if($examDetails->hasResult == "yes")
            @if($examDetails->confirmed == "no")
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                     <div class="h-full p-4 py-3 bg-gray-200 border-2 border-solid rounded-md border-slate-400">
                      <h2 class="text-2xl font-bold text-center text-blue-600 ">RESULT OF YOUR PLMAT APPLICATION</h2>
                      </div>
                      <div class="h-full p-4 py-3 bg-white rounded-md">
                        @if($examDetails->remark == "with")
                            <p class="text-base"> Greetings future Haribon! We are glad to announce that you have passed the PLMAT for the upcoming school year. The results of your exam are provided below and your assigned course.<br></p>
                            <br><p>If you wish to continue enrolling for the next school year, please confirm your slot with the button below</p>
                        @elseif($examDetails->remark == "without")
                            <p class="font-sans text-lg font-bold">Greetings future Haribon!</p>
                            <br>
                            <p class="text-base">We are glad to announce that you have passed the PLMAT for the upcoming school year.</p>
                           <p class="text-base"> But you have beed placed as a waitlisted. Please wait for the e-mail for the opening of course selection.</p>
                        @else   
                            <p class="text-base">Your result is not yet out. Please check back later.</p>
                        @endif
                    
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-col gap-2">
                            <br>
                            <h3 class="text-base font-bold">Exam Score</h3>
                            <p class="text-sm">{{ $examDetails->score }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h3 class="text-base font-bold">Overall Ranking</h3>
                            <p class="text-sm">{{ $examDetails->rank }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h3 class="text-base font-bold">Remarks</h3>
                            <p class="text-sm">
                                @if($examDetails->remark == "with")
                                    Passed with Offered Course
                                @elseif($examDetails->remark == "without")
                                    Waitlisted
                                @endif
                            </p>
                        </div>

                        @if($examDetails->remark == "with")
                            <div class="flex flex-col gap-2">
                                <h3 class="text-lg font-medium">Offered Course</h3>
                                <p class="text-sm">{{ $examDetails->courseOffer }}</p>
                            </div>

                            <a href="{{ route('applicant.confirm.slot', ['currentRoute' => $currentRoute, 'applicantId' => $applicantId]) }}" class="px-4 py-2 text-white bg-red-600 w-fit">Confirm Slot</a>
                        @endif
                        
                    </div>
                </div>
            @else
                <div class="flex flex-col gap-4">
                    <h2 class="text-3xl font-bold">Congratulation future Haribon!</h2>
                    <p>You have successfully confirmed your slot for the upcoming school year. Please await for further instructions.</p>
                </div>
            @endif
        @endif
    
</div>