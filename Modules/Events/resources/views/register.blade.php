<x-layouts.frontend>
    <x-slot:title>Register | Pantonix Tiger Run Dhaka</x-slot:title>

    <style>
        /* Custom Utilities */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .input-field {
            width: 100%;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            color: #1f2937;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .input-field:focus {
            outline: none;
            border-color: #F97316; /* brand-tiger */
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.15);
        }

        .input-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        #navbar.scrolled {
            background-color: rgba(6, 78, 59, 0.98);
            backdrop-filter: blur(5px);
            padding-top: 1rem;
            padding-bottom: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>

    <header class="bg-brand-green pt-36 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'#ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h4 class="text-brand-tiger font-bold uppercase tracking-[0.3em] mb-3 text-sm opacity-90">Secure Your Spot</h4>
            <h1 class="font-display text-4xl md:text-5xl font-extrabold text-white mb-4">Event Registration</h1>
            <p class="text-gray-200 text-lg max-w-2xl mx-auto font-light">Fill out the form below to secure your kit and participation in the upcoming marathon.</p>
        </div>
    </header>

    <section class="py-16 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-gold/10 rounded-full blur-[100px] -translate-y-1/4 translate-x-1/4 z-0"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-brand-green/5 rounded-full blur-[100px] translate-y-1/4 -translate-x-1/4 z-0"></div>

        <div class="container mx-auto px-6 relative z-10 max-w-5xl">
            
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-5 rounded-2xl mb-8 shadow-sm">
                    <h4 class="font-bold flex items-center gap-2 mb-2">Please fix the following errors:</h4>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border border-brand-green text-brand-green px-6 py-5 rounded-2xl mb-8 shadow-sm">
                    <h4 class="font-bold flex items-center gap-2 mb-2">Success!</h4>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif
            
            <form id="marathon-form" action="{{ route('events.register.submit') }}" method="POST" enctype="multipart/form-data" class="glass-card p-8 md:p-12 rounded-[2rem] shadow-2xl space-y-12 border-t-8 border-t-brand-tiger text-left">
                @csrf

                <div>
                    <div class="flex items-center gap-4 mb-8 border-b border-gray-200 pb-4">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center font-bold text-lg shadow-md">1</div>
                        <h3 class="font-display text-2xl font-extrabold text-brand-green">Personal Information</h3>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="input-label">First Name <span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" class="input-field" placeholder="Enter your first name" value="{{ old('first_name') }}" required>
                        </div>
                        <div>
                            <label class="input-label">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" class="input-field" placeholder="Enter your last name" value="{{ old('last_name') }}" required>
                        </div>
                        <div>
                            <label class="input-label">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" class="input-field" placeholder="john@example.com" value="{{ old('email') }}" required>
                        </div>
                        <div>
                            <label class="input-label">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone" class="input-field" placeholder="+880 1XXX XXXXXX" value="{{ old('phone') }}" required>
                        </div>
                        <div>
                            <label class="input-label">Date of Birth <span class="text-red-500">*</span></label>
                            <input type="text" id="dob-input" name="date_of_birth" class="input-field" placeholder="DD/MM/YYYY" maxlength="10" value="{{ old('date_of_birth') }}" required>
                        </div>
                        <div>
                            <label class="input-label text-gray-400">Age Category (Auto)</label>
                            <input type="text" id="age-category" name="age_category" class="input-field bg-gray-50 border-gray-200 text-brand-tiger font-bold cursor-not-allowed" readonly placeholder="Calculated from DOB" value="{{ old('age_category') }}">
                        </div>
                        <div>
                            <label class="input-label">Gender <span class="text-red-500">*</span></label>
                            <select name="gender" class="input-field cursor-pointer" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="input-label">Nationality (Optional)</label>
                            <input type="text" name="nationality" class="input-field" placeholder="e.g. Bangladeshi" value="{{ old('nationality') }}">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-4 mb-8 border-b border-gray-200 pb-4">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center font-bold text-lg shadow-md">2</div>
                        <h3 class="font-display text-2xl font-extrabold text-brand-green">Race Information</h3>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="input-label">Select Event <span class="text-red-500">*</span></label>
                            <select name="event_id" id="event-select" class="input-field cursor-pointer border-brand-tiger/50" required>
                                <option value="" data-fee="0" data-categories="[]">-- Select Event --</option>
                                @if(isset($events) && $events->count() > 0)
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" 
                                                data-fee="{{ $event->base_registration_fee ?? 0 }}"
                                                data-categories="{{ json_encode($event->categories ?? []) }}"
                                                data-allow-infant="{{ $event->allow_infants ? '1' : '0' }}"
                                                data-allow-kid="{{ $event->allow_kids ? '1' : '0' }}"
                                                data-allow-adult="{{ $event->allow_adults ? '1' : '0' }}"
                                                {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <label class="input-label">Race Category <span class="text-red-500">*</span></label>
                            <select name="race_category" id="category-select" class="input-field cursor-pointer" required>
                                <option value="">Select Event First</option>
                            </select>
                        </div>
                        <div>
                            <label class="input-label">T-Shirt Size <span class="text-red-500">*</span></label>
                            <select name="t_shirt_size" class="input-field cursor-pointer" required>
                                <option value="">Select Size</option>
                                <option value="S" {{ old('t_shirt_size') == 'S' ? 'selected' : '' }}>Small (S)</option>
                                <option value="M" {{ old('t_shirt_size') == 'M' ? 'selected' : '' }}>Medium (M)</option>
                                <option value="L" {{ old('t_shirt_size') == 'L' ? 'selected' : '' }}>Large (L)</option>
                                <option value="XL" {{ old('t_shirt_size') == 'XL' ? 'selected' : '' }}>Extra Large (XL)</option>
                                <option value="XXL" {{ old('t_shirt_size') == 'XXL' ? 'selected' : '' }}>Double XL (XXL)</option>
                            </select>
                        </div>
                        <div>
                            <label class="input-label">Expected Finish Time (Optional)</label>
                            <input type="text" name="expected_finish_time" class="input-field" placeholder="e.g. 01:30 (hh:mm)" value="{{ old('expected_finish_time') }}">
                        </div>
                        <div>
                            <label class="input-label">Club / Team (Optional)</label>
                            <input type="text" name="club_or_team" class="input-field" placeholder="Your running club" value="{{ old('club_or_team') }}">
                        </div>
                        <div>
                            <label class="input-label">Total Previous Marathons (Optional)</label>
                            <input type="number" name="previous_marathons" class="input-field" min="0" placeholder="0" value="{{ old('previous_marathons') }}">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-4 mb-8 border-b border-gray-200 pb-4">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center font-bold text-lg shadow-md">3</div>
                        <h3 class="font-display text-2xl font-extrabold text-brand-green">Health & Emergency</h3>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="input-label">Blood Group <span class="text-red-500">*</span></label>
                            <select name="blood_group" class="input-field cursor-pointer" required>
                                <option value="">Select Blood Group</option>
                                <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                            </select>
                        </div>
                        <div>
                            <label class="input-label">Medical Conditions (Optional)</label>
                            <input type="text" name="medical_conditions" class="input-field" placeholder="Asthma, Diabetes, etc." value="{{ old('medical_conditions') }}">
                        </div>
                        <div>
                            <label class="input-label">Emergency Contact Name <span class="text-red-500">*</span></label>
                            <input type="text" name="emergency_contact_name" class="input-field" required placeholder="Full Name" value="{{ old('emergency_contact_name') }}">
                        </div>
                        <div>
                            <label class="input-label">Emergency Contact Phone <span class="text-red-500">*</span></label>
                            <input type="tel" name="emergency_contact_phone" class="input-field" required placeholder="Phone Number" value="{{ old('emergency_contact_phone') }}">
                        </div>
                        <div class="md:col-span-2">
                            <label class="input-label">Emergency Contact Relation <span class="text-red-500">*</span></label>
                            <input type="text" name="emergency_contact_relation" class="input-field md:w-1/2" required placeholder="Spouse, Parent, Friend, etc." value="{{ old('emergency_contact_relation') }}">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-4 mb-8 border-b border-gray-200 pb-4">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center font-bold text-lg shadow-md">4</div>
                        <h3 class="font-display text-2xl font-extrabold text-brand-green">Mailing Address</h3>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="input-label">Address Line <span class="text-red-500">*</span></label>
                            <input type="text" name="address_line" class="input-field" required placeholder="Street address, apartment, suite, etc." value="{{ old('address_line') }}">
                        </div>
                        <div>
                            <label class="input-label">City <span class="text-red-500">*</span></label>
                            <input type="text" name="city" class="input-field" required placeholder="City" value="{{ old('city') }}">
                        </div>
                        <div>
                            <label class="input-label">State / District <span class="text-red-500">*</span></label>
                            <input type="text" name="state_or_district" class="input-field" required placeholder="State or District" value="{{ old('state_or_district') }}">
                        </div>
                        <div>
                            <label class="input-label">Postal Code <span class="text-red-500">*</span></label>
                            <input type="text" name="postal_code" class="input-field" required placeholder="Postal Code" value="{{ old('postal_code') }}">
                        </div>
                        <div>
                            <label class="input-label">Country <span class="text-red-500">*</span></label>
                            <input type="text" name="country" class="input-field" required value="{{ old('country', 'Bangladesh') }}">
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-4 mb-8 border-b border-gray-200 pb-4">
                        <div class="w-10 h-10 rounded-full bg-brand-green text-white flex items-center justify-center font-bold text-lg shadow-md">5</div>
                        <h3 class="font-display text-2xl font-extrabold text-brand-green">Final Steps</h3>
                    </div>

                    <div class="grid md:grid-cols-2 gap-10">
                        <div class="bg-brand-cream/50 p-6 rounded-2xl border border-dashed border-gray-300">
                            <label class="input-label">Runner ID Photo <span class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-500 mb-4 leading-relaxed">Please upload a clear headshot. Max size 5MB. Our system will automatically optimize it.</p>
                            
                            <div class="relative">
                                <input type="file" id="photo-input" name="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-tiger/10 file:text-brand-tiger hover:file:bg-brand-tiger/20 transition-all cursor-pointer" accept="image/*" required>
                            </div>
                            <div id="photo-status" class="mt-3 text-sm text-brand-green font-bold hidden flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Image optimized & ready!
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div id="fee-container" class="hidden">
                                <label class="input-label">Registration Fee</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold"></span>
                                    <input type="text" id="fee-display" name="registration_fee" class="input-field pl-14 bg-gray-50 font-display font-extrabold text-xl text-brand-green cursor-not-allowed" readonly value="{{ old('registration_fee', '0') }}">
                                </div>
                            </div>

                            <div class="space-y-4 bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                                <label class="flex items-start gap-3 cursor-pointer group">
                                    <div class="mt-0.5">
                                        <input type="checkbox" name="waiver_accepted" value="1" required class="w-5 h-5 text-brand-tiger rounded border-gray-300 focus:ring-brand-tiger cursor-pointer">
                                    </div>
                                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">I accept the event waiver and confirm I am medically and physically fit to participate in this event. <span class="text-red-500">*</span></span>
                                </label>

                                <label class="flex items-start gap-3 cursor-pointer group">
                                    <div class="mt-0.5">
                                        <input type="checkbox" name="terms_accepted" value="1" required class="w-5 h-5 text-brand-tiger rounded border-gray-300 focus:ring-brand-tiger cursor-pointer">
                                    </div>
                                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">I agree to the <a href="#" class="text-brand-tiger hover:underline">Terms & Conditions</a> and privacy policy. <span class="text-red-500">*</span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center pt-8 border-t border-gray-200">
                    <button type="submit" class="bg-brand-tiger text-white font-display font-bold text-lg px-12 py-4 rounded-full shadow-[0_10px_20px_rgba(249,115,22,0.3)] hover:shadow-[0_15px_25px_rgba(249,115,22,0.4)] hover:bg-orange-600 transition-all transform hover:-translate-y-1 active:scale-95 w-full md:w-auto">
                        Proceed to Payment
                    </button>
                    <p class="text-xs text-gray-500 mt-4 flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7z"></path></svg>
                        Secure 256-bit encryption for payment
                    </p>
                </div>

            </form>
        </div>
    </section>

    @push('scripts')
    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // Use sandbox for local testing, securepay for production
                script.src = "{{ env('APP_ENV') === 'local' ? 'https://sandbox.sslcommerz.com/embed.min.js' : 'https://seamless-epay.sslcommerz.com/embed.min.js' }}?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };
            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            const eventSelect = document.getElementById('event-select');
            const categorySelect = document.getElementById('category-select');
            const feeDisplay = document.getElementById('fee-display');
            const feeContainer = document.getElementById('fee-container'); // Added variable
            const dobInput = document.getElementById('dob-input');
            const ageCategoryInput = document.getElementById('age-category');
            const oldCategory = "{{ old('race_category') }}";

            // --- 0. Core Age Restriction and Data Update Logic ---
            function updateFormBasedOnEvent() {
                const selectedOption = eventSelect.options[eventSelect.selectedIndex];
                
                if (!selectedOption || !selectedOption.value) {
                    feeDisplay.value = '0';
                    categorySelect.innerHTML = '<option value="">Select Event First</option>';
                    feeContainer.classList.add('hidden'); // Added hide logic
                    return;
                }

                const fee = selectedOption.getAttribute('data-fee');
                feeDisplay.value = fee ? fee : '0';
                feeContainer.classList.remove('hidden'); // Added show logic

                const categoriesRaw = selectedOption.getAttribute('data-categories');
                categorySelect.innerHTML = '<option value="">Select Distance</option>';
                if (categoriesRaw && categoriesRaw !== 'null') {
                    try {
                        const categories = JSON.parse(categoriesRaw);
                        categories.forEach(cat => {
                            const opt = document.createElement('option');
                            opt.value = cat;
                            opt.textContent = cat;
                            if (cat === oldCategory) opt.selected = true;
                            categorySelect.appendChild(opt);
                        });
                    } catch (e) { console.error(e); }
                }

                checkAgeEligibility();
            }

            function checkAgeEligibility() {
                const selectedOption = eventSelect.options[eventSelect.selectedIndex];
                const currentCategory = ageCategoryInput.value;

                if (!selectedOption.value || !currentCategory) return;

                const allowInfant = selectedOption.getAttribute('data-allow-infant') === '1';
                const allowKid = selectedOption.getAttribute('data-allow-kid') === '1';
                const allowAdult = selectedOption.getAttribute('data-allow-adult') === '1';

                let isDisallowed = false;
                let message = "";

                if (currentCategory.includes('Infant') && !allowInfant) {
                    isDisallowed = true; message = "Infants (Age 7-10) are not allowed for this specific event.";
                } else if (currentCategory.includes('Kid') && !allowKid) {
                    isDisallowed = true; message = "Kids (Age 11-14) are not allowed for this specific event.";
                } else if (currentCategory.includes('Adult') && !allowAdult) {
                    isDisallowed = true; message = "This event is reserved for younger participants. Adult runners are not allowed.";
                } else if (currentCategory.includes('Not Eligible')) {
                    isDisallowed = true; message = "Participants under age 7 are not eligible to register.";
                }

                if (isDisallowed) {
                    alert("⚠️ RESTRICTION ERROR:\n\n" + message + "\n\nPlease select a different event or update your information.");
                    eventSelect.value = "";
                    feeDisplay.value = "0";
                    feeContainer.classList.add('hidden'); // Added logic to hide on error
                    categorySelect.innerHTML = '<option value="">Select Event First</option>';
                }
            }

            eventSelect.addEventListener('change', updateFormBasedOnEvent);

            // --- 1. DOB Masking & Age Calculation ---
            dobInput.addEventListener('input', function(e) {
                if (e.inputType === 'deleteContentBackward') return;

                let val = this.value.replace(/\D/g, ''); 
                if (val.length > 4) {
                    val = val.substring(0, 2) + '/' + val.substring(2, 4) + '/' + val.substring(4, 8);
                } else if (val.length > 2) {
                    val = val.substring(0, 2) + '/' + val.substring(2, 4);
                }
                this.value = val;

                if (this.value.length === 10) {
                    const parts = this.value.split('/');
                    const day = parseInt(parts[0], 10);
                    const month = parseInt(parts[1], 10) - 1; 
                    const year = parseInt(parts[2], 10);

                    const dob = new Date(year, month, day);
                    const today = new Date();
                    let age = today.getFullYear() - dob.getFullYear();
                    const m = today.getMonth() - dob.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) { age--; }

                    let category = '';
                    if (age >= 7 && age <= 10) { category = '7-10 Infant'; }
                    else if (age >= 11 && age <= 14) { category = '11-14 Kid'; }
                    else if (age >= 15) { category = 'Adult Runner'; }
                    else { category = 'Under 7 (Not Eligible)'; }
                    
                    ageCategoryInput.value = category;
                    checkAgeEligibility(); 
                } else {
                    ageCategoryInput.value = '';
                }
            });

            if(eventSelect.value) { updateFormBasedOnEvent(); }

            // --- 2. Image Compression Logic ---
            const photoInput = document.getElementById('photo-input');
            const photoStatus = document.getElementById('photo-status');
            photoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (!file) { photoStatus.classList.add('hidden'); return; }
                if (file.size > 5 * 1024 * 1024) {
                    alert("File size must be under 5MB.");
                    this.value = ""; photoStatus.classList.add('hidden'); return;
                }
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        const canvas = document.createElement('canvas');
                        const MAX_WIDTH = 1000; 
                        const scaleSize = MAX_WIDTH / img.width;
                        canvas.width = img.width > MAX_WIDTH ? MAX_WIDTH : img.width;
                        canvas.height = img.width > MAX_WIDTH ? img.height * scaleSize : img.height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        const dataUrl = canvas.toDataURL('image/jpeg', 0.8); 
                        fetch(dataUrl).then(res => res.blob()).then(blob => {
                            const newFile = new File([blob], file.name, { type: 'image/jpeg', lastModified: new Date().getTime() });
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(newFile);
                            photoInput.files = dataTransfer.files;
                            photoStatus.classList.remove('hidden');
                        });
                    };
                };
            });

            // --- 3. AJAX Submission for SSL Commerz Popup ---
            const form = document.getElementById('marathon-form');
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Stop standard form submission

                // Basic Validation Check
                const requiredFields = form.querySelectorAll('[required]');
                let missingFields = [];
                requiredFields.forEach(field => {
                    if (!field.value.trim() && field.type !== 'checkbox' && field.type !== 'file') {
                        let labelText = field.previousElementSibling ? field.previousElementSibling.innerText.replace('*', '').trim() : field.name;
                        missingFields.push(labelText);
                    } else if (field.type === 'checkbox' && !field.checked) {
                        missingFields.push("Agreements");
                    } else if (field.type === 'file' && field.files.length === 0) {
                        missingFields.push("Runner ID Photo");
                    }
                });

                if (missingFields.length > 0) {
                    alert("Please complete mandatory fields:\n• " + missingFields.join("\n• "));
                    return;
                }

                // Change button state
                const originalBtnText = submitButton.innerHTML;
                submitButton.innerHTML = "Initializing Payment...";
                submitButton.disabled = true;

                // Gather form data
                const formData = new FormData(form);

                // Send AJAX request to Laravel Backend
                fetch("{{ route('events.register.submit') }}", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json' // Forces Laravel to return JSON errors instead of HTML pages
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    // Success! Data contains the secure session key from SSL Commerz
                    if (data.status === 'success' && data.GatewayPageURL) {
                        // Launch the popup iframe!
                        window.location.href = data.GatewayPageURL; 
                    } else {
                        alert("Payment gateway error. Please try again.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    let errorMsg = "An error occurred during submission.";
                    if (error.errors) {
                        // Format Laravel validation errors cleanly for the alert box
                        errorMsg = Object.values(error.errors).flat().join('\n');
                    } else if (error.message) {
                        errorMsg = error.message; // Catch server exceptions
                    }
                    alert(errorMsg);
                })
                .finally(() => {
                    // Restore button state
                    submitButton.innerHTML = originalBtnText;
                    submitButton.disabled = false;
                });
            });

            // Navbar scroll logic
            const navbar = document.getElementById('navbar');
            if (navbar) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) navbar.classList.add('shadow-lg');
                    else navbar.classList.remove('shadow-lg');
                });
            }
        });
    </script>
    @endpush
</x-layouts.frontend>