<x-layouts.base>
    <div class="flex h-screen overflow-hidden">
        <div
                class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden"
        >
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <div
                            class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
                    >
                        <div class="flex flex-wrap items-center">
                            <div class="hidden w-full xl:block xl:w-1/2">
                                <div class="px-26 py-17.5 text-center">
                                    <span class="mt-15 inline-block">
                      <img
                              src="{{asset('assets/images/illustration/illustration-03.svg')}}"
                              alt="illustration"
                      />
                    </span>
                                </div>
                            </div>
                            <div
                                    class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2"
                            >
                                <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                                    <h2
                                            class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2"
                                    >
                                        Sign In
                                    </h2>
                                    <form method="POST" action="{{route('login.attempt')}}">
                                        @csrf
                                        <div class="mb-4">
                                            <x-pages-components.auth.inputs.email/>
                                            @if($errors->has('email'))
                                                <div class="error">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="mb-6">
                                            <x-pages-components.auth.inputs.password/>
                                            @if($errors->has('email'))
                                                <div class="error">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="mb-5">
                                            @include('components/ui/buttons/default')
                                        </div>
                                        <div class="mt-6 text-center ">
                                            <p class="font-medium">
                                                Don’t have any account?
                                                <a href="register" class="text-primary">Sign Up</a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-layouts.base>
