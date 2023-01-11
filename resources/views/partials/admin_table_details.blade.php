                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            	@canBeImpersonated($user,$guard=null)
                            	<a href="{{route('admin.impersonate',$user->id)}}" data-toggle='tooltip' data-placement='top' title="Impersonate" class="icon-style"><span class="badge badge-pill badge-success">Impersonate</span>
                            	</a> 
                            	@endCanBeImpersonated
                            </td>
                            <td>
                                @if($user->isBanned())
                                    <label class="text-danger">Yes</label>
                                @else
                                    <label class="text-success">No</label>
                                @endif
                            </td>
                            <td>
                                @if($user->isBanned())
                                    <a href="{{route('admin.revoke',[$user->id])}}">
                                        <span class="text-danger">Revoke</span>
                                    </a>
                                @else
                                    <a href="{{route('admin.bann',$user->id)}}">
                                        <span class="text-success">Bann</span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if(Cache::has('is_online' . $user->id))
                                    <label class="badge badge-pill badge-success">Online</label>
                                @else
                                    <label class="badge badge-pill badge-danger">Offline</label>
                                @endif
                            </td>
                            <td>
                                <label class="badge badge-info badge-pill">
                                    {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                </label>
                            </td>