<?php
namespace App\Http\Controllers;

use App\Actions\Contact\CreateContact;
use App\Actions\Contact\DeleteContact;
use App\Actions\Contact\UpdateContact;
use App\DTOs\ContactData;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Contact;
use App\Services\ContactService;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    use AuthorizesRequests;
    public function __construct(protected ContactService $service) {}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Inertia\Response
     */
    public function show(Contact $contact): Response
    {
        $this->authorize('view', $contact);

        return Inertia::render('Contacts/Show', [
            'contact' => $contact,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $this->authorize('viewAny', Contact::class);

        return Inertia::render('Contacts/Index', [
            'contacts' => Contact::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $this->authorize('create', Contact::class);

        return Inertia::render('Contacts/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContactRequest $request
     * @param CreateContact $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContactRequest $request, CreateContact $action) : \Illuminate\Http\RedirectResponse
    {
        $action->handle(ContactData::fromArray($request->validated()));

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Contact $contact
     * @return Response
     */
    public function edit(Contact $contact): Response
    {
        $this->authorize('view', $contact);

        return Inertia::render('Contacts/Edit', [
            'contact' => $contact,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContactRequest $request
     * @param Contact $contact
     * @param UpdateContact $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateContactRequest $request, Contact $contact, UpdateContact $action)
    {
        $action->handle($contact, ContactData::fromArray($request->validated()));

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     * @param DeleteContact $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact, DeleteContact $action)
    {
        $this->authorize('delete', $contact);

        $action->handle($contact->id);

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact deleted.');
    }
}
