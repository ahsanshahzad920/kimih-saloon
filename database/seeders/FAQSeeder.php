<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FAQSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'question' => 'How do I set up my business on Kimih?',
                'answer' => '<ul><li><strong>Login</strong><ul><li>Click the login button.</li><li>Enter your email address.</li><li>If an account exists, you will be logged in.</li><li>If not, you will be redirected to the registration form.</li></ul></li><li><strong>Registration</strong>:<ul><li>Fill out the registration form with your business name and website address.</li><li>Click "Continue."</li></ul></li><li><strong>Services Selection</strong>:<ul><li>Choose the services you need.</li><li>Click "Continue."</li></ul></li><li><strong>Team Size</strong>:<ul><li>Select your team size.</li><li>Click "Continue."</li></ul></li><li><strong>Business Location</strong>:<ul><li>Enter your business location details.</li><li>Submit the form.</li></ul></li><li><strong>Completion</strong>:<ul><li>Your business account will be set up successfully.</li></ul></li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I add my business location?',
                'answer' => '<p>To change or add your business location, please follow these steps:</p><ul><li>Go to your dashboard.</li><li>Click on your profile avatar.</li><li>Select "Profile."</li><li>Navigate to the "Business Details" tab.</li><li>Here, you can update or add your business location.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Can I customize my business profile',
                'answer' => '<p>To change or add your business location, please follow these steps:</p><ul><li>Go to your dashboard.</li><li>Click on your profile avatar.</li><li>Select "Profile."</li><li>Navigate to the "Profile" tab.</li><li>Here, you can update or add your business location.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I add my services?',
                'answer' => '<p>To add new services, follow these steps:</p><ul><li>Click on the "Catalogue" icon in the sidebar.</li><li>A dropdown menu will appear; select "Services."</li><li>A new interface will be displayed with an "Add Services" button.</li><li>Click on the "Add Services" button.</li><li>A form will appear; complete the form to add your services.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I add my staff members?',
                'answer' => '<p>To add a new team member, follow these steps:</p><ul><li>Click on the "Team" option in the sidebar.</li><li>A dropdown menu will appear; select "Team Members."</li><li>You will be navigated to the Team Members page.</li><li>Click on the "Add Team Member" button.</li><li>A form will appear; complete the form to add the new team member.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I customize my appointment settings?',
                'answer' => '<p>To view and edit your appointments, follow these steps:</p><ul><li>Click on the "Sales" option in the sidebar.</li><li>Select the "Appointments" option from the dropdown menu.</li><li>All your appointments will be displayed.</li><li>You can edit appointments directly from this page.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I book an appointment?',
                'answer' => '<p>To book an appointment, follow these steps:</p><ul><li>On the front page, click on the "Store" to view available appointments.</li><li>Select the "Book Now" option.</li><li>A modal will open; choose your desired appointment and click "Continue."</li><li>Select the date for your appointment and click "Continue."</li><li>Complete the payment process to finalize your appointment booking.</li></ul><p>Your appointment will be successfully booked upon completion of these steps.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Can I edit or cancel an appointment?',
                'answer' => '<p>To view and manage your appointments, follow these steps:</p><ul><li>Click on the "Menu" from the navbar.</li><li>Select "My Appointments" from the dropdown.</li><li>All your booked appointments will be displayed.</li><li>To cancel an appointment, click on the "Cancel" option next to the desired appointment.</li><li>Confirm the cancellation when prompted.</li></ul><p>Your appointment will be successfully canceled upon confirmation.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I send appointment reminders to clients?',
                'answer' => '<p>A reminder message will be sent to the client\'s number 24 hours before the scheduled appointment date.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Can I set up recurring appointments?',
                'answer' => '<p>No, currently not.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I view my appointment calendar?',
                'answer' => '<p>To view all your appointments on a calendar, follow these steps:</p><ul><li>Click on the "Calendar" option in the sidebar.</li><li>Your appointments will be displayed on the calendar.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I reschedule appointments?',
                'answer' => '<p>No currently not.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I set up online booking?',
                'answer' => '<p>To book an appointment, follow these steps:</p><ul><li>On the front page, click on the "Store" to view available appointments.</li><li>Select the "Book Now" option.</li><li>A modal will open; choose your desired appointment and click "Continue."</li><li>Select the date for your appointment and click "Continue."</li><li>Complete the payment process to finalize your appointment booking.</li></ul><p>Your appointment will be successfully booked upon completion of these steps.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Can I send marketing emails to my clients?',
                'answer' => '<p>To send marketing emails, follow these steps:</p><ul><li>Click on the "Marketing" option in the sidebar.</li><li>Select "Leads" from the dropdown menu and add your leads.</li><li>Click on the "Email Marketing" option from the Marketing menu.</li><li>Fill out the form and send emails to your clients.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I add or remove staff members?',
                'answer' => '<p>To remove a staff member, follow these steps:</p><ul><li>Click on the "Team" option in the sidebar.</li><li>Select "Team Members" from the dropdown menu.</li><li>A list of all team members will be displayed.</li><li>From this list, select the staff member you wish to remove.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Can I set different permissions for my staff?',
                'answer' => '<p>To set permissions for staff, follow these steps:</p><ul><li>Click on the "User Management" option in the sidebar.</li><li>Select the "Permissions" option.</li><li>A list of roles with their associated permissions will be displayed.</li><li>You can change existing permissions or set new ones from this page.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I add new clients to my database?',
                'answer' => '<p>To add new clients to your database, follow these steps:</p><ul><li>Click on the "Clients" option in the sidebar.</li><li>A dropdown menu will appear; select "Clients List."</li><li>The list of your clients will be displayed.</li><li>Click on the "Add New Client" button.</li><li>Fill out the form to add a new client.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Can I import client information from another system?',
                'answer' => '<p>No currently not.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I manage client appointments?',
                'answer' => '<p>To view and edit your client\'s appointments, follow these steps:</p><ul><li>Click on the "Sales" option in the sidebar.</li><li>Select the "Appointments" option from the dropdown menu.</li><li>All your appointments will be displayed.</li><li>You can edit appointments directly from this page.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I contact Kimih support?',
                'answer' => '<p>To contact Kimih support, follow these steps:</p><ul><li>Navigate to the landing page.</li><li>Click on the "Menu" option.</li><li>Select the "Support" option.</li><li>Fill out the contact form.</li></ul><p>Our team will respond to you within 24 hours.</p><p>&nbsp;</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Where can I find tutorials and guides?',
                'answer' => '<p>To find guides or contact us for support, you have two options:</p><p><strong>Interactive Support Chat System:</strong></p><ul><li>Click on the support icon at the bottom right of the screen.</li><li>Select from the list of common problems with solutions.</li><li>If you don’t find your solution, type your message to describe the problem.</li></ul><p><strong>Support System:</strong></p><ul><li>Navigate to the landing page.</li><li>Click on the "Menu" option.</li><li>Select "Support."</li><li>Fill out the form.</li></ul><p>Our team will contact you within 24 hours.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'What should I do if I encounter technical issues?',
                'answer' => '<p>To find solution, you have two options:</p><p>&nbsp;</p><p><strong>Interactive Support Chat System:</strong></p><ul><li>Click on the support icon at the bottom right of the screen.</li><li>Select from the list of common problems with solutions.</li><li>If you don’t find your solution, type your message to describe the problem.</li></ul><p><strong>Support System:</strong></p><ul><li>Navigate to the landing page.</li><li>Click on the "Menu" option.</li><li>Select "Support."</li><li>Fill out the form.</li></ul><p>Our team will contact you within 24 hours.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Is there a user manual available for Kimih?',
                'answer' => '<p>No currently not.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I book an appointment online?',
                'answer' => '<p>To book an appointment, follow these steps:</p><ul><li>On the front page, click on the "Store" to view available appointments.</li><li>Select the "Book Now" option.</li><li>A modal will open; choose your desired appointment and click "Continue."</li><li>Select the date for your appointment and click "Continue."</li><li>Complete the payment process to finalize your appointment booking.</li></ul><p>Your appointment will be successfully booked upon completion of these steps.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Can I reschedule or cancel my appointment?',
                'answer' => '<p>To view and manage your appointments, follow these steps:</p><ul><li>Click on the "Menu" from the navbar.</li><li>Select "My Appointments" from the dropdown.</li><li>All your booked appointments will be displayed.</li><li>To cancel an appointment, click on the "Cancel" option next to the desired appointment.</li><li>Confirm the cancellation when prompted.</li></ul><p>Your appointment will be successfully canceled upon confirmation.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Will I receive a reminder for my upcoming appointment?',
                'answer' => '<p>No currently note.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How can I view my appointment history?',
                'answer' => '<p>To view your booked appointment history, follow these steps:</p><ul><li>Click on the menu icon in the top navbar.</li><li>Select the "Appointments" option.</li><li>All your appointments will be displayed there.</li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'What should I do if I need to make changes to my booking?',
                'answer' => '<p>Currently, you can only cancel your bookings. To do this, click on the menu option in the top navbar and select the "Appointments" option. All your appointments will appear with a cancellation option. Click on "Cancel" and, after confirmation, your appointment will be canceled.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How can I find out what services are offered?',
                'answer' => '<p>All the services offered by different stores are listed on the landing page.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Where can I see the pricing for different services?',
                'answer' => '<p>The landing page lists all the services offered by different stores and their prices.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Are there any discounts or promotions available?',
                'answer' => '<p>No currently not</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Can I purchase gift certificates or packages?',
                'answer' => '<p>Yes, you can purchase plans or packages by visiting the pricing page. All available packages and their services are listed there, allowing you to choose and buy the one that suits your needs.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'What payment methods are accepted?',
                'answer' => '<p>Currently, the supported payment method is Stripe. However, you can also pay through your wallet for bookings.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Is there an option to pay online?',
                'answer' => '<p>Yes, you can pay through Stripe.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I know if my payment was successful?',
                'answer' => '<p>After completing your payment, you will be redirected to your bookings or products page, accompanied by a success message.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Can I get a refund if I cancel my appointment?',
                'answer' => '<p>Yes, upon canceling your appointment, the amount will be refunded to your wallet.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I create a customer account on Kimih?',
                'answer' => '<ul><li><strong>Login</strong><ul><li>Click the login button.</li><li>Enter your email address.</li><li>If an account exists, you will be logged in.</li><li>If not, you will be redirected to the registration form.</li></ul></li><li><strong>Registration</strong>:<ul><li>Fill out the registration form with your personal details.</li><li>Click “Continue.”</li></ul></li><li><strong>Completion</strong>:<ul><li>Your account will be set up successfully.</li></ul></li></ul>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'What should I do if I forget my password?',
                'answer' => '<p>To reset your password, click on the "Login" option from the navbar menu. Enter your email address and continue. Then, click on "Forgot Password" and provide the email associated with your account. We will send you a reset password link with instructions to your email.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How can I update my personal information?',
                'answer' => '<p>Click on the menu in the top navbar and select the "Profile" option. Your profile details will be displayed, and you can update them from this page.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How do I delete my account?',
                'answer' => '<p>You can address this by contacting support.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'What should I do if I encounter technical issues while booking?',
                'answer' => '<p>To find solution, you have two options:</p><p>&nbsp;</p><p><strong>Interactive Support Chat System:</strong></p><ul><li>Click on the support icon at the bottom right of the screen.</li><li>Select from the list of common problems with solutions.</li><li>If you don’t find your solution, type your message to describe the problem.</li></ul><p><strong>Support System:</strong></p><ul><li>Navigate to the landing page.</li><li>Click on the "Menu" option.</li><li>Select "Support."</li><li>Fill out the form.</li></ul><p>Our team will contact you within 24 hours.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'How can I contact customer support?',
                'answer' => '<p>To contact Kimih support, follow these steps:</p><ul><li>Navigate to the landing page.</li><li>Click on the "Menu" option.</li><li>Select the "Support" option.</li><li>Fill out the contact form.</li></ul><p>Our team will respond to you within 24 hours.</p><p>&nbsp;</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Where can I find tutorials or guides for using the booking system?',
                'answer' => '<p>To find guides or contact us for support, you have two options:</p><p><strong>Interactive Support Chat System:</strong></p><ul><li>Click on the support icon at the bottom right of the screen.</li><li>Select from the list of common problems with solutions.</li><li>If you don’t find your solution, type your message to describe the problem.</li></ul><p><strong>Support System:</strong></p><ul><li>Navigate to the landing page.</li><li>Click on the "Menu" option.</li><li>Select "Support."</li><li>Fill out the form.</li></ul><p>Our team will contact you within 24 hours.</p>',
                'user_id' => auth()->id()
            ],
            [
                'question' => 'Is there a mobile app available for booking appointments?',
                'answer' => '<p>No currently not.</p>',
                'user_id' => auth()->id()
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
