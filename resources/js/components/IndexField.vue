<template>
	<div :class="`text-${field.textAlign}`">
		<tooltip trigger="hover">
			<div class="text-primary inline-flex items-center dim cursor-pointer">
				<!-- <span class="text-primary font-bold">{{ __("View") }}</span> -->
                <p>
                    <img
                    v-if="field.image"
                    :src="field.image"
                    style="object-fit: cover"
                    class="align-bottom w-8 h-8"
                    :class="{ 'rounded-full': field.rounded, rounded: !field.rounded }"
                    />
                    <span v-else>&mdash;</span>
                </p>
			</div>

			<tooltip-content slot="content">
				<template v-if="field.image !== undefined">
					<img :src="field.image" :alt="__('Photo')" :width="field.width"/>
				</template>
				<ul class="list-reset">
					<li v-for="option in value" class="mb-1" :key="option">
						<span
							v-if="option.label"
							class="inline-flex items-center py-1 pl-2 pr-3 rounded-full font-bold text-sm"
						>
							<span class="ml-1">{{ option.name }}</span>
							<span class="ml-1">{{ option.label }}</span>
						</span>
					</li>
				</ul>
			</tooltip-content>
		</tooltip>
	</div>
</template>

<script>
export default {
	props: ["resourceName", "field"],

	data: () => ({
		image: "",
		value: []
	}),
	created() {
		this.image = this.field.image;
		this.field.value = this.field.value || {};

		this.value = _(this.field.options)
			.map(o => {
				return {
					name: o.name,
					label: o.label
				};
			})
			.value();
	}
};
</script>
