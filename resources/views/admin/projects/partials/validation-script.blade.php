<script>
(function () {
    function applyOldInput(form, oldInput) {
        Object.keys(oldInput).forEach(function(name) {
            if (name === '_token' || name === '_method') {
                return;
            }

            var value = oldInput[name];
            var inputs = form.find('[name="' + name + '"], [name="' + name + '[]"]');

            if (!inputs.length) {
                return;
            }

            var firstInput = inputs.first();
            var inputType = (firstInput.attr('type') || '').toLowerCase();

            if (inputType === 'file') {
                return;
            }

            if (inputType === 'checkbox' || inputType === 'radio') {
                var values = Array.isArray(value) ? value.map(String) : [String(value)];

                inputs.each(function() {
                    var current = $(this);
                    var currentValue = String(current.val());
                    var shouldCheck = values.indexOf(currentValue) !== -1;

                    if (!shouldCheck && inputType === 'checkbox' && values.length === 1 && (values[0] === '1' || values[0] === 'true' || values[0] === 'on')) {
                        shouldCheck = currentValue === '1' || currentValue === 'on';
                    }

                    current.prop('checked', shouldCheck);
                });

                return;
            }

            inputs.val(value);
        });

        if (oldInput.description) {
            $('#description').val(oldInput.description);

            if (window.quill) {
                window.quill.root.innerHTML = oldInput.description;
            }

            if ($('#fallback-description').length) {
                $('#fallback-description').val(oldInput.description);
            }
        }
    }

    function clearProjectFormErrors(form) {
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.project-invalid-feedback').remove();
    }

    function normalizedCandidates(field) {
        var baseField = field.replace(/\.\*$/, '').replace(/\.\d+$/, '');
        var candidates = [field, baseField];

        if (baseField !== field) {
            candidates.push(baseField + '[]');
        }

        return candidates;
    }

    function findField(form, field) {
        var candidates = normalizedCandidates(field);
        var match = $();

        candidates.some(function(candidate) {
            match = form.find('[name="' + candidate + '"]');
            return match.length > 0;
        });

        if (match.length) {
            return match.first();
        }

        var idCandidate = field.replace(/\.\*$/, '').replace(/\.\d+$/, '').replace(/\[\]/g, '');
        return form.find('#' + idCandidate).first();
    }

    function feedbackContainer(input) {
        var group = input.closest('.form-group');

        if (group.length) {
            return group;
        }

        return input.parent();
    }

    window.applyProjectFormErrors = function(errors) {
        var form = $('#project-form');

        if (!form.length) {
            return;
        }

        clearProjectFormErrors(form);

        var firstInvalidField = null;

        Object.keys(errors).forEach(function(field) {
            var input = findField(form, field);

            if (!input.length) {
                return;
            }

            if (!firstInvalidField) {
                firstInvalidField = input;
            }

            input.addClass('is-invalid');

            var message = errors[field][0];
            var container = feedbackContainer(input);

            if (!container.find('.project-invalid-feedback').length) {
                container.append('<div class="invalid-feedback d-block project-invalid-feedback">' + $('<div>').text(message).html() + '</div>');
            }
        });

        if (firstInvalidField) {
            $('html, body').animate({
                scrollTop: Math.max(firstInvalidField.offset().top - 140, 0)
            }, 200);
        }
    };

    $(function() {
        var initialErrors = @json($errors->messages());
        var oldInput = @json(session()->getOldInput());
        var form = $('#project-form');

        if (oldInput && Object.keys(oldInput).length && form.length) {
            applyOldInput(form, oldInput);
        }

        if (initialErrors && Object.keys(initialErrors).length) {
            window.applyProjectFormErrors(initialErrors);
        }
    });
})();
</script>
