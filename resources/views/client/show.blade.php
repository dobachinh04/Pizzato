{{-- demo detail product client  --}}

<table>
    <tr>
        <th>Field name</th>
        <th>Value</th>
    </tr>
    <tbody>
        @foreach ($product->toArray() as $field => $value)
            <tr>
                <td>
                    @if ($field == 'category_id')
                        Category
                    @else
                        {{ Str::ucfirst(str_replace('_', ' ', $field)) }}
                    @endif
                </td>

                <td>
                    @if ($field == 'thumb_image')
                        <img src="{{ Storage::url($value) }}" alt="" width="50px">
                    @elseif (Str::contains($field, 'show_at_home'))
                        <span class="badge {{ $value ? 'bg-primary' : 'bg-danger' }}">
                            {{ $value ? 'YES' : 'NO' }}
                        </span>
                    @elseif (Str::contains($field, 'status'))
                        <span class="badge {{ $value ? 'bg-primary' : 'bg-danger' }}">
                            {{ $value ? 'YES' : 'NO' }}
                        </span>
                    @elseif ($field == 'category_id')
                        {{ $product->category->name }}
                    @else
                        {{ $value }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
