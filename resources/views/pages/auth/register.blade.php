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
                                        Sign Up
                                    </h2>
                                    <form method="POST" action="{{route('register.perform')}}">
                                        @csrf
                                        <div class = "mb-4">
                                            <div>
                                                <label
                                                    class="mb-2.5 block font-medium text-black dark:text-white"
                                                >Name</label
                                                >
                                                <div class="relative">
                                                    <input
                                                        type="text"
                                                        placeholder="Enter your name"
                                                        name="name"
                                                        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                    />
                                                </div>
                                                @if($errors->has('name'))
                                                    <div class="text-red-50">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <x-pages-components.auth.inputs.email/>
                                            @if($errors->has('email'))
                                                <div class="text-red-50">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="mb-6">
                                            <x-pages-components.auth.inputs.password/>
                                            @if($errors->has('password'))
                                                <div class="text-red-50">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                        <div class="mb-6">
                                            <div>
                                                <label
                                                    class="mb-2.5 block font-medium text-black dark:text-white"
                                                >Password confirmation</label
                                                >
                                                <div class="relative mb-6">
                                                    <input type="password" name="password_confirmation" placeholder="Confirm your password"
                                                        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                    /> <span class="absolute right-4 top-4">
                                                       <x-ui.icons.lock/>
                                                      </span>
                                                </div>
                                            </div>
                                            @if($errors->has('password_confirmation'))
                                                <div class="text-red-50">{{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        <div class="mb-5">
                                            @include('components/ui/buttons/default')
                                        </div>
                                        <div class="mt-6 text-center ">
                                            <p class="font-medium">
                                                Already have an account?
                                                <a href="login" class="text-primary">Sign In</a>
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
