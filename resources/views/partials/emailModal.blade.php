<div class="modal fade trans-white-background" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content trans-white-background p-5">
            <form action="/contact-us" method="POST" id="emailForm">
                @csrf
                <div class="form-group">
                    <label for="emailName">Your Name:</label>
                    <input type="text" name="name" class="form-control" id="emailName" placeholder="Jane Doe" required>
                </div>
                <div class="form-group">
                    <label for="emailAddress">Reply Email:</label>
                    <input type="email" name="email" class="form-control" id="emailAddresss" placeholder="Jane@example.com" required>
                </div>
                <div class="form-group">
                    <label for="emailSubject">Subject:</label>
                    <input type="text" name="subject" class="form-control" id="emailSubject" placeholder="I Love Your Pins!" required>
                </div>
                <div class="form-group">
                    <label for="emailMessage">Your Message:</label>
                    <textarea name="message" class="form-control" id="emailMessage" rows="10" required></textarea>
                </div>
                <button type="submit" class="btn btn-outline-info btn-block mb-4">Send Message</button>
                <button type="submit" class="btn btn-outline-secondary btn-block" id="cancelSendEmail" data-dismiss="modal">Cancel</button>
            </form>
        </div>
    </div>
</div>