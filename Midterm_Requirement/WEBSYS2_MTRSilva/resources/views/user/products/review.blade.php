<form action="{{ route('product.submitReview', ['id' => $product->id]) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="review" class="form-label">Your Review</label>
        <textarea class="form-control" id="review" name="review" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <select class="form-select" id="rating" name="rating" required>
            <option value="1">1 Star</option>
            <option value="2">2 Stars</option>
            <option value="3">3 Stars</option>
            <option value="4">4 Stars</option>
            <option value="5">5 Stars</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit Review</button>
</form>
