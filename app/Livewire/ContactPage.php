<?php

namespace App\Livewire;

use App\Models\Inquiry;
use Livewire\Component;
use App\Mail\NewInquiryNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\View\View;

class ContactPage extends Component
{
    public $name = '';
    public $email = '';
    public $company_name = '';
    public $role = '';
    public $budget = 500; // Set default to $500
    public $message = '';

    public $title = "Contact | Rublevsky Studio";
    public $metaDescription = "Get in touch with Rublevsky Studio for your web design, branding, or creative project needs. Let's discuss how we can bring your vision to life.";

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'company_name' => 'nullable|string|max:255',
        'role' => 'nullable|string|max:255',
        'budget' => 'required|numeric|min:500|max:100000',
        'message' => 'required|string',
    ];

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'budget.required' => 'Please select a budget.',
        'budget.min' => 'The budget must be at least $500.',
        'budget.max' => 'The budget cannot exceed $100,000.',
        'message.required' => 'Please enter your message.',
    ];

    public function mount()
    {
        $this->budget = 500; // Ensure the default value is set when the component is mounted
    }

    public function submitForm()
    {
        $this->validate();

        $inquiry = Inquiry::create([
            'name' => $this->name,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'role' => $this->role,
            'budget' => $this->budget,
            'message' => $this->message,
        ]);

        Mail::to(config('mail.admin_email'))->send(new NewInquiryNotification($inquiry));

        $this->reset(['name', 'email', 'company_name', 'role', 'budget', 'message',]);

        session()->flash('message', 'Your inquiry has been submitted successfully!');
    }

    public function render(): View
    {
        return view('livewire.contact-page', [
            'title' => $this->title,
            'metaDescription' => $this->metaDescription
        ]);
    }
}
