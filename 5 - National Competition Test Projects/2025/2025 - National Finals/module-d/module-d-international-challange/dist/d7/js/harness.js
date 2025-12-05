/*
  js/harness.js
  =================
  Test harness for running and displaying results. Do not modify
*/

(function () {
  function deepEqual(a, b) {
    return JSON.stringify(a) === JSON.stringify(b);
  }

  function run() {
    const listContainer = document.getElementById('resultsList');
    const summary = document.getElementById('summary');
    const tests = Array.isArray(window.__TESTS__) ? window.__TESTS__ : [];
    let passed = 0;

    if (!listContainer || !summary) {
      console.error('Required DOM elements for test harness not found.');
      return;
    }

    listContainer.innerHTML = '';

    // 1. Group tests by function name
    const groupedTests = tests.reduce((acc, test) => {
      if (!acc[test.fn]) {
        acc[test.fn] = [];
      }
      acc[test.fn].push(test);
      return acc;
    }, {});

    // 2. Render each group
    for (const fnName in groupedTests) {
      const groupDiv = document.createElement('div');
      groupDiv.className = 'test-group';

      const header = document.createElement('h3');
      header.className = 'group-header';
      header.textContent = fnName;
      groupDiv.appendChild(header);

      const innerList = document.createElement('ul');
      groupDiv.appendChild(innerList);

      groupedTests[fnName].forEach((t) => {
        const li = document.createElement('li');
        const nameSpan = document.createElement('span');
        const resultBadge = document.createElement('span');
        const fn =
          typeof window[t.fn] === 'function' ? window[t.fn] : undefined;

        let ok = false,
          actual,
          error = null;

        try {
          if (!fn) throw new Error(`Function "${t.fn}" not found`);
          actual = fn.apply(null, t.args || []);
          ok = deepEqual(actual, t.expected);
        } catch (e) {
          error = e.message;
        }

        if (ok) passed++;

        // Use the test name without the function part
        const displayName = t.name.split(' - ')[1] || t.name;
        nameSpan.textContent =
          displayName.charAt(0).toUpperCase() + displayName.slice(1);
        resultBadge.className = ok ? 'badge pass' : 'badge fail';
        resultBadge.textContent = ok ? 'PASS' : 'FAIL';

        li.append(nameSpan, resultBadge);

        if (!ok) {
          const detail = document.createElement('div');
          const expectedStr = JSON.stringify(t.expected);
          const actualStr = JSON.stringify(actual);
          detail.textContent = error
            ? `Error: ${error}`
            : `Expected ${expectedStr}, got ${actualStr}`;
          li.appendChild(detail);
        }
        innerList.appendChild(li);
      });
      listContainer.appendChild(groupDiv);
    }

    summary.textContent = `Passed ${passed}/${tests.length} tests`;
    document.getElementById('test-results').setAttribute('aria-busy', 'false');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', run);
  } else {
    run();
  }
})();
