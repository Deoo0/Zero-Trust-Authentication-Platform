<!-- resources/views/auth/hub.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexusAuth - Zero Trust Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50" x-data="auth()">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-12 w-12 bg-blue-600 rounded-full flex items-center justify-center">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Welcome back
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Choose your secure login method
                </p>
            </div>

            <!-- Authentication Options -->
            <div class="mt-8 space-y-4">
                
                <!-- Passkey Option -->
                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:border-blue-300 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-lg p-2">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Use Passkey</h3>
                                <p class="text-sm text-gray-500">Face ID, Touch ID, or security key</p>
                            </div>
                        </div>
                        <button @click="authenticateWithPasskey()" 
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Continue
                        </button>
                    </div>
                </div>

                <!-- Magic Link Option -->
                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:border-green-300 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-green-100 rounded-lg p-2">
                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Email me a link</h3>
                                <p class="text-sm text-gray-500">Passwordless login via email</p>
                            </div>
                        </div>
                        <button @click="showMagicLink = true" 
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Send Link
                        </button>
                    </div>
                </div>

                <!-- 2FA Option -->
                <div class="bg-white rounded-lg border border-gray-200 p-4 hover:border-purple-300 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-purple-100 rounded-lg p-2">
                                <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Authenticator App</h3>
                                <p class="text-sm text-gray-500">Use 6-digit code from your app</p>
                            </div>
                        </div>
                        <button @click="show2FA = true" 
                                class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            Enter Code
                        </button>
                    </div>
                </div>

            </div>

            <!-- Traditional Login Fallback -->
            <div class="text-center mt-6">
                <button @click="showTraditionalLogin()" class="text-blue-600 hover:text-blue-500 text-sm">
                    Use traditional username and password
                </button>
            </div>

        </div>
    </div>

    <!-- Magic Link Form Modal -->
    <div x-show="showMagicLink" x-cloak class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Send Magic Link</h3>
                <div class="mt-2">
                    <input type="email" placeholder="Enter your email" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex gap-2 mt-4">
                    <button @click="showMagicLink = false" class="flex-1 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                        Cancel
                    </button>
                    <button class="flex-1 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Send Link
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 2FA Form Modal -->
    <div x-show="show2FA" x-cloak class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Enter 2FA Code</h3>
                <div class="mt-2">
                    <input type="text" maxlength="6" pattern="[0-9]*" inputmode="numeric" placeholder="000000"
                           class="w-full text-center text-2xl tracking-widest border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-sm text-gray-500 mt-2 text-center">Enter the 6-digit code from your authenticator app</p>
                </div>
                <div class="flex gap-2 mt-4">
                    <button @click="show2FA = false" class="flex-1 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                        Cancel
                    </button>
                    <button class="flex-1 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors">
                        Verify
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function auth() {
            return {
                showMagicLink: false,
                show2FA: false,
                
                authenticateWithPasskey() {
                    alert('Passkey authentication would start here...');
                    // WebAuthn implementation would go here
                },

                showTraditionalLogin() {
                    window.location.href = '/login';
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>