export function capitalizeWord(word) {
  if (word) {
    return word.charAt(0).toUpperCase() + word.slice(1)
  }
}