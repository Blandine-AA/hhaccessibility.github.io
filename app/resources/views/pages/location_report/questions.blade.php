<h2>{{ $question_category->name }}</h2>

<div>
	<div class="questions">
		@foreach ( $question_category->questions()->get() as $question )
			<div>
				{!! $question->question_html !!}
				@if ($question->explanation)
						@include('pages.components.question_explanation_link',
						array(
							'question_id' => $question->id
							)
						)
				@endif

				<span class="percentage">
				{!! $question->getAccessibilityRating($location_id, 'universal') !!}%
				</span>
				<span class="user-count">
				{!! $user_counts[$question->id] !!}
				</span>
			</div>
		@endforeach
	</div>
	<div class="comments">
		<h2>Comments</h2>
		@if ( count($comments) === 0 )
			<p>There are no comments for this category.</p>
		@else
			@foreach ( $comments as $comment )
				<div class="comment">
					<div class="comment-header">
						{{ $comment->getAnsweredByUser()->first_name }}
						{{ $comment->getAnsweredByUser()->last_name }}
						said,
						
						<span class="pull-right">
						{{ $comment->getWhenSubmitted() }}
						</span>
					</div>
					<div class="comment-content">
						{{ $comment->content }}
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>